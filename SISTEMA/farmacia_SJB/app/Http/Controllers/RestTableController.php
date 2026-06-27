<?php

namespace App\Http\Controllers;

use App\Models\RestTable;
use Illuminate\Http\Request;

class RestTableController extends Controller
{
    /**
     * Muestra la lista de mesas registradas en el establecimiento.
     */
    public function index()
    {
        $tables = RestTable::orderBy('table_number', 'asc')->get();
        return view('tables.index', compact('tables'));
    }

    /**
     * Muestra el formulario para registrar una nueva mesa.
     */
    public function create()
    {
        return view('tables.create');
    }

    /**
     * Almacena una nueva mesa validando los enums de la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'table_number' => 'required|string|max:50|unique:tables,table_number',
            'capacity'     => 'required|integer|min:1|max:50',
            'status'       => 'required|in:available,occupied,reserved',
            'location'     => 'required|in:main_hall,terrace,bar,delivery',
        ]);

        RestTable::create($validatedData);

        return redirect()->route('tables.index')
            ->with('success', 'Mesa registrada de forma exitosa.');
    }

    /**
     * Muestra el formulario de edición usando Route Model Binding.
     */
    public function edit(RestTable $restTable)
    {
        return view('tables.edit', compact('restTable'));
    }

    /**
     * Actualiza la mesa controlando la excepción única del número de mesa.
     */
    public function update(Request $request, RestTable $restTable)
    {
        $validatedData = $request->validate([
            'table_number' => 'required|string|max:50|unique:tables,table_number,' . $restTable->id,
            'capacity'     => 'required|integer|min:1|max:50',
            'status'       => 'required|in:available,occupied,reserved',
            'location'     => 'required|in:main_hall,terrace,bar,delivery',
        ]);

        $restTable->update($validatedData);

        return redirect()->route('tables.index')
            ->with('success', 'Configuración de la mesa actualizada.');
    }

    /**
     * Elimina una mesa validando que no tenga comandas activas o históricas.
     */
    public function destroy(RestTable $restTable)
    {
        // Control de integridad: Impedir eliminar mesas con historial de pedidos
        if ($restTable->orders()->count() > 0) {
            return redirect()->route('tables.index')
                ->with('error', 'No se puede eliminar la mesa porque cuenta con historial de pedidos o comandas en el sistema.');
        }

        $restTable->delete();

        return redirect()->route('tables.index')
            ->with('success', 'Mesa removida del catálogo operativo con éxito.');
    }
}