<?php

namespace App\Http\Controllers;

use App\Models\RestTable;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WaiterOrderController extends Controller
{
    /**
     * Muestra el salón con el estado en tiempo real de todas las mesas para el mozo.
     */
    public function index()
    {
        $tables = RestTable::orderBy('table_number', 'asc')->get();
        return view('waiter.index', compact('tables'));
    }

    /**
     * Muestra el formulario para abrir una comanda en una mesa específica.
     */
    public function create(RestTable $restTable)
    {
        if ($restTable->status === 'occupied') {
            return redirect()->route('waiter.index')
                ->with('error', 'La mesa seleccionada ya se encuentra ocupada por otra comanda.');
        }

        return view('waiter.create', compact('restTable'));
    }

    /**
     * Registra la apertura de la comanda y cambia el estado de la mesa a ocupada.
     */
    public function store(Request $request, RestTable $restTable)
    {
        $request->validate([
            'customer_name' => 'nullable|string|max:100',
        ]);

        if ($restTable->status === 'occupied') {
            return redirect()->route('waiter.index')
                ->with('error', 'La mesa fue ocupada por otro mozo hace unos momentos.');
        }

        DB::transaction(function () use ($request, $restTable) {
            $dateSegment = date('Ymd');
            $randomSegment = strtoupper(substr(uniqid(), -4));
            $invoiceNumber = "ORD-{$dateSegment}-{$randomSegment}";

            Order::create([
                'invoice_number' => $invoiceNumber,
                'user_id'        => Auth::id(),
                'table_id'       => $restTable->id,
                'customer_id'    => null,
                'customer_name'  => $request->input('customer_name') ?: 'Clientes Varios',
                'subtotal'       => 0.00,
                'igv_percentage' => 18.00,
                'igv'            => 0.00,
                'total'          => 0.00,
                'status'         => 'pending',
            ]);

            $restTable->update(['status' => 'occupied']);
        });

        return redirect()->route('waiter.index')
            ->with('success', 'Mesa abierta con éxito. Ahora puedes añadir platos a la comanda desde el panel de la mesa.');
    }

    /**
     * Muestra el detalle de la comanda activa de una mesa ocupada.
     */
    public function show(RestTable $restTable)
    {
        $order = Order::where('table_id', $restTable->id)
            ->whereNotIn('status', ['paid', 'cancelled'])
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('waiter.index')
                ->with('error', 'No se encontró ninguna comanda activa para esta mesa.');
        }

        // Corrección: Filtrado por el campo real 'is_active'
        $dishes = Dish::where('is_active', true)->orderBy('name', 'asc')->get();

        return view('waiter.show', compact('restTable', 'order', 'dishes'));
    }

    /**
     * Añade un plato o bebida a la comanda activa de la mesa y recalcula los totales.
     */
    public function addDish(Request $request, RestTable $restTable)
    {
        $request->validate([
            'dish_id'  => 'required|exists:dishes,id',
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        $order = Order::where('table_id', $restTable->id)
            ->whereNotIn('status', ['paid', 'cancelled'])
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('waiter.index')
                ->with('error', 'La comanda ya no se encuentra activa.');
        }

        $dish = Dish::find($request->dish_id);
        $quantity = $request->quantity;
        $price = $dish->price;
        $subtotalLine = $price * $quantity;

        DB::transaction(function () use ($order, $dish, $quantity, $price, $subtotalLine) {
            $order->details()->create([
                'dish_id'  => $dish->id,
                'quantity' => $quantity,
                'price'    => $price,
                'subtotal' => $subtotalLine,
            ]);

            $newSubtotal = $order->details()->sum('subtotal');
            $igvPercentage = $order->igv_percentage;
            
            $newIgv = $newSubtotal * ($igvPercentage / 100);
            $newTotal = $newSubtotal + $newIgv;

            $order->update([
                'subtotal' => $newSubtotal,
                'igv'      => $newIgv,
                'total'    => $newTotal,
                'status'   => $order->status === 'pending' ? 'in_kitchen' : $order->status
            ]);
        });

        return redirect()->route('waiter.orders.show', ['restTable' => $restTable->id])
            ->with('success', "Se añadió {$quantity}x {$dish->name} correctamente.");
    }
}