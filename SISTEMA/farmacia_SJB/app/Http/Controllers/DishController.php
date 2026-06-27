<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Muestra la lista de platos con Eager Loading para optimizar rendimiento.
     */
    public function index()
    {
        // Cargamos la categoría con 'with' para evitar N+1 consultas en la base de datos
        $dishes = Dish::with('category')->orderBy('name', 'asc')->get();
        return view('dishes.index', compact('dishes'));
    }

    /**
     * Muestra el formulario de creación inyectando las categorías activas.
     */
    public function create()
    {
        $categories = MenuCategory::where('is_active', true)->orderBy('display_order', 'asc')->get();
        return view('dishes.create', compact('categories'));
    }

    /**
     * Almacena un nuevo plato aplicando validaciones estrictas.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'menu_category_id' => 'required|exists:menu_categories,id',
            'name'             => 'required|string|max:255|unique:dishes,name',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0.00|max:999999.99',
            'stock'            => 'required|integer|min:0',
            'is_active'        => 'required|boolean',
        ]);

        Dish::create($validatedData);

        return redirect()->route('dishes.index')
            ->with('success', 'Plato registrado exitosamente en el catálogo.');
    }

    /**
     * Muestra el formulario de edición usando Route Model Binding.
     */
    public function edit(Dish $dish)
    {
        $categories = MenuCategory::where('is_active', true)->orderBy('display_order', 'asc')->get();
        return view('dishes.edit', compact('dish', 'categories'));
    }

    /**
     * Actualiza el plato controlando la excepción única del nombre sobre sí mismo.
     */
    public function update(Request $request, Dish $dish)
    {
        $validatedData = $request->validate([
            'menu_category_id' => 'required|exists:menu_categories,id',
            'name'             => 'required|string|max:255|unique:dishes,name,' . $dish->id,
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0.00|max:999999.99',
            'stock'            => 'required|integer|min:0',
            'is_active'        => 'required|boolean',
        ]);

        $dish->update($validatedData);

        return redirect()->route('dishes.index')
            ->with('success', 'Plato actualizado correctamente.');
    }

    /**
     * Elimina un plato validando que no comprometa pedidos históricos.
     */
    public function destroy(Dish $dish)
    {
        // Control de integridad: No eliminar platos que ya posean comandas/pedidos
        if ($dish->orderDetails()->count() > 0) {
            return redirect()->route('dishes.index')
                ->with('error', 'No se puede eliminar el plato porque pertenece al historial de pedidos activos.');
        }

        $dish->delete();

        return redirect()->route('dishes.index')
            ->with('success', 'Plato removido del catálogo de forma segura.');
    }
}