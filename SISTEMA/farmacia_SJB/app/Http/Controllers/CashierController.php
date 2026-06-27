<?php

namespace App\Http\Controllers;

use App\Models\RestTable;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    /**
     * Muestra la lista de mesas ocupadas o comandas pendientes de cobro.
     */
    public function index()
    {
        // Traemos las mesas que están ocupadas para proceder con su facturación
        $tables = RestTable::where('status', 'occupied')->orderBy('table_number', 'asc')->get();
        return view('cashier.index', compact('tables'));
    }

    /**
     * Muestra la precuenta de la mesa y el formulario para seleccionar el método de pago.
     */
    public function showCheckout(RestTable $restTable)
    {
        // Buscar la comanda activa de la mesa
        $order = Order::where('table_id', $restTable->id)
            ->whereNotIn('status', ['paid', 'cancelled'])
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('cashier.index')
                ->with('error', 'No hay ninguna comanda activa para liquidar en esta mesa.');
        }

        return view('cashier.checkout', compact('restTable', 'order'));
    }

    /**
     * Procesa el cobro de la comanda, congela el método de pago y libera la mesa.
     */
    public function processPayment(Request $request, RestTable $restTable)
    {
        // Validar que el método de pago sea uno de los definidos en el ENUM de la migración
        $request->validate([
            'payment_method' => 'required|in:cash,card,yape_plin',
        ]);

        $order = Order::where('table_id', $restTable->id)
            ->whereNotIn('status', ['paid', 'cancelled'])
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('cashier.index')
                ->with('error', 'La comanda ya fue procesada o cancelada.');
        }

        // Ejecutar el cobro y la liberación en un bloque transaccional seguro
        DB::transaction(function () use ($request, $order, $restTable) {
            
            // 1. Actualizar la cabecera de la orden con el pago efectivo
            $order->update([
                'payment_method' => $request->input('payment_method'),
                'status'         => 'paid'
            ]);

            // 2. Liberar la mesa inmediatamente para el próximo cliente
            $restTable->update([
                'status' => 'available'
            ]);
        });

        return redirect()->route('cashier.index')
            ->with('success', "Comanda {$order->invoice_number} cobrada con éxito. Mesa liberada.");
    }
}