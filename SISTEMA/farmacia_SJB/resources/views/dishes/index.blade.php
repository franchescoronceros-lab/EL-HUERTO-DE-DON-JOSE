@extends('layouts.app')

@section('title', 'Gestión de Platos - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>🍔 Catálogo de Platos y Bebidas</h2>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅️ Volver al Panel</a>
            <a href="{{ route('dishes.create') }}" class="btn btn-primary">➕ Nuevo Plato</a>
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
                <th>Nombre del Plato</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th style="width: 100px; text-align: center;">Stock</th>
                <th style="width: 100px;">Estado</th>
                <th style="width: 180px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dishes as $dish)
                <tr>
                    <td>
                        <strong>{{ $dish->name }}</strong>
                        @if($dish->description)
                            <br><small style="color: #666;">{{ $dish->description }}</small>
                        @endif
                    </td>
                    <td><span style="background: #e9ecef; padding: 4px 8px; border-radius: 4px; font-size: 0.9em;">{{ $dish->category->name }}</span></td>
                    <td><strong>S/. {{ number_format($dish->price, 2) }}</strong></td>
                    <td style="text-align: center;">{{ $dish->stock }} u.</td>
                    <td>
                        @if($dish->is_active)
                            <span class="badge badge-success">Disponible</span>
                        @else
                            <span class="badge badge-danger">Agotado</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('dishes.edit', $dish->id) }}" class="btn btn-warning">Editar</a>
                        
                        <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST" class="actions-form" onsubmit="return confirm('¿Está seguro de eliminar este plato del menú?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #777; padding: 30px;">
                        No hay platos ni bebidas registrados en el catálogo actualmente.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection