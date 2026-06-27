@extends('layouts.app')

@section('title', 'Gestión de Mesas - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>🪑 Inventario de Mesas del Salón</h2>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅️ Volver al Panel</a>
            <a href="{{ route('tables.create') }}" class="btn btn-primary">➕ Nueva Mesa</a>
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
                <th>Código / Número de Mesa</th>
                <th>Ubicación / Área</th>
                <th style="text-align: center;">Capacidad Máxima</th>
                <th>Estado Actual</th>
                <th style="width: 180px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tables as $table)
                <tr>
                    <td><strong>{{ $table->table_number }}</strong></td>
                    <td>
                        @switch($table->location)
                            @case('main_hall') Salón Principal @break
                            @case('terrace') Terraza @break
                            @case('bar') Barra de Tragos @break
                            @case('delivery') Delivery / Llevar @break
                            @default {{ $table->location }}
                        @endswitch
                    </td>
                    <td style="text-align: center;">{{ $table->capacity }} comensales</td>
                    <td>
                        @switch($table->status)
                            @case('available') <span class="badge badge-success">Disponible (Libre)</span> @break
                            @case('occupied') <span class="badge badge-danger">Ocupada</span> @break
                            @case('reserved') <span class="badge badge-warning">Reservada</span> @break
                            @default <span class="badge">{{ $table->status }}</span>
                        @endswitch
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-warning">Editar</a>
                        
                        <form action="{{ route('tables.destroy', $table->id) }}" method="POST" class="actions-form" onsubmit="return confirm('¿Está seguro de remover esta mesa del salón?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #777; padding: 30px;">
                        No hay mesas configuradas en el establecimiento actualmente.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection