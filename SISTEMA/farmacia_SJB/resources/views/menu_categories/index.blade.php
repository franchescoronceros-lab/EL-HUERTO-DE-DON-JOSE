@extends('layouts.app')

@section('title', 'Gestión de Categorías - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>📂 Categorías del Menú</h2>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅️ Volver al Panel</a>
            <a href="{{ route('menu-categories.create') }}" class="btn btn-primary">➕ Nueva Categoría</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th style="width: 80px;">Orden</th>
                <th>Nombre de la Categoría</th>
                <th>Descripción</th>
                <th style="width: 100px;">Estado</th>
                <th style="width: 180px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td><strong>#{{ $category->display_order }}</strong></td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? 'Sin descripción proporcionada.' }}</td>
                    <td>
                        @if($category->is_active)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">Inactivo</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('menu-categories.edit', $category->id) }}" class="btn btn-warning">Editar</a>
                        
                        <form action="{{ route('menu-categories.destroy', $category->id) }}" method="POST" class="actions-form" onsubmit="return confirm('¿Está seguro de eliminar esta categoría?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #777; padding: 30px;">
                        No hay categorías registradas en el menú actualmente.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection