<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Medicine;
use App\Models\DetailSale;

class salesController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer', 'details.medicine')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $medicines = Medicine::all();
        return view('sales.create', compact('customers', 'medicines'));
    }

    public function store(Request $request)
    {
        $medicine = Medicine::findOrFail($request->medicine_id);

        $subtotal = $medicine->price * $request->amount;
        $igv = $subtotal * 0.18;
        $total = $subtotal + $igv;

        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'igv' => $igv,
            'total' => $total,
        ]);

        DetailSale::create([
            'sale_id' => $sale->id,
            'medicine_id' => $medicine->id,
            'amount' => $request->amount,
            'price_unit' => $medicine->price,
            'subtotal' => $subtotal,
        ]);

        $medicine->stock -= $request->amount;
        $medicine->save();

        return redirect()->route('sales.index');
    }

    public function show($id)
    {
        return redirect()->route('sales.index');
    }

    public function edit($id)
    {
        $sale = Sale::with('details')->findOrFail($id);
        $customers = Customer::all();
        $medicines = Medicine::all();

        return view('sales.edit', compact('sale', 'customers', 'medicines'));
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::with('details')->findOrFail($id);
        $detail = $sale->details->first();

        if ($detail) {
            $oldMedicine = Medicine::find($detail->medicine_id);
            if ($oldMedicine) {
                $oldMedicine->stock += $detail->amount;
                $oldMedicine->save();
            }

            $detail->delete();
        }

        $medicine = Medicine::findOrFail($request->medicine_id);

        $subtotal = $medicine->price * $request->amount;
        $igv = $subtotal * 0.18;
        $total = $subtotal + $igv;

        $sale->update([
            'customer_id' => $request->customer_id,
            'igv' => $igv,
            'total' => $total,
        ]);

        DetailSale::create([
            'sale_id' => $sale->id,
            'medicine_id' => $medicine->id,
            'amount' => $request->amount,
            'price_unit' => $medicine->price,
            'subtotal' => $subtotal,
        ]);

        $medicine->stock -= $request->amount;
        $medicine->save();

        return redirect()->route('sales.index');
    }

    public function destroy($id)
    {
        $sale = Sale::with('details')->findOrFail($id);

        foreach ($sale->details as $detail) {
            $medicine = Medicine::find($detail->medicine_id);

            if ($medicine) {
                $medicine->stock += $detail->amount;
                $medicine->save();
            }
        }

        $sale->delete();

        return redirect()->route('sales.index');
    }
}