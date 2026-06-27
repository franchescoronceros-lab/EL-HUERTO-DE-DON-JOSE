<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    /**
     * Muestra la lista de categorías del menú.
     * Vista asociada: resources/views/menu_categories/index.blade.php
     */
    public function index()
    {
        $categories = MenuCategory::orderBy('display_order', 'asc')->get();
        return view('menu_categories.index', compact('categories'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     * Vista asociada: resources/views/menu_categories/create.blade.php
     */
    public function create()
    {
        return view('menu_categories.create');
    }

    /**
     * Almacena una nueva categoría en la base de datos de forma segura.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255|unique:menu_categories,name',
            'description'   => 'nullable|string',
            'display_order' => 'required|integer|min:1',
            'is_active'     => 'required|boolean',
        ]);

        MenuCategory::create($validatedData);

        return redirect()->route('menu-categories.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una categoría existente utilizando Route Model Binding.
     * Vista asociada: resources/views/menu_categories/edit.blade.php
     */
    public function edit(MenuCategory $menuCategory)
    {
        return view('menu_categories.edit', compact('menuCategory'));
    }

    /**
     * Actualiza una categoría utilizando Route Model Binding de forma segura.
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255|unique:menu_categories,name,' . $menuCategory->id,
            'description'   => 'nullable|string',
            'display_order' => 'required|integer|min:1',
            'is_active'     => 'required|boolean',
        ]);

        $menuCategory->update($validatedData);

        return redirect()->route('menu-categories.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Elimina una categoría asegurando la integridad referencial.
     */
    public function destroy(MenuCategory $menuCategory)
    {
        // Control de integridad: evitar huérfanos en platos utilizando la relación del modelo
        if ($menuCategory->dishes()->count() > 0) {
            return redirect()->route('menu-categories.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene platos asociados.');
        }

        $menuCategory->delete();

        return redirect()->route('menu-categories.index')
            ->with('success', 'Categoría eliminada del sistema.');
    }
}