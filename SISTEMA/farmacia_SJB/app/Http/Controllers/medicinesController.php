<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Category;

class medicinesController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('category')->get();

        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('medicines.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Medicine::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('medicines.index')
            ->with('success', 'Plato registrado correctamente.');
    }

    public function show($id)
    {
        return redirect()->route('medicines.index');
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        $categories = Category::all();

        return view('medicines.edit', compact('medicine', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $medicine = Medicine::findOrFail($id);

        $medicine->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('medicines.index')
            ->with('success', 'Plato actualizado correctamente.');
    }

    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);

        $medicine->delete();

        return redirect()->route('medicines.index')
            ->with('success', 'Plato eliminado correctamente.');
    }
}