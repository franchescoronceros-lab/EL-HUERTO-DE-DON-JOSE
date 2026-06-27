@extends('layouts.app')

@section('title', 'Salón de Mesas - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>🍽️ Estado del Salón en Tiempo Real</h2>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; margin-top: 20px;">
        @forelse($tables as $table)
            @php
                $cardBg = '#fff';
                $borderTopColor = '#6c757d';
                
                if ($table->status === 'available') {
                    $borderTopColor = '#28a745';
                } elseif ($table->status === 'occupied') {
                    $borderTopColor = '#dc3545';
                } elseif ($table->status === 'reserved') {
                    $borderTopColor = '#ffc107';
                }
            @endphp

            <div style="background: {{ $cardBg }}; border-radius: 8px; border: 1px solid #ddd; border-top: 5px solid {{ $borderTopColor }}; padding: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h3 style="margin: 0 0 8px 0; color: #333;">{{ $table->table_number }}</h3>
                    <p style="margin: 0 0 5px 0; font-size: 0.9em; color: #666;">
                        📍 <strong>Zona:</strong> 
                        @switch($table->location)
                            @case('main_hall') Salón Principal @break
                            @case('terrace') Terraza @break
                            @case('bar') Barra de Tragos @break
                            @case('delivery') Llevar / Delivery @break
                            @default {{ $table->location }}
                        @endswitch
                    </p>
                    <p style="margin: 0 0 15px 0; font-size: 0.9em; color: #666;">
                        👥 <strong>Capacidad:</strong> Max. {{ $table->capacity }} pers.
                    </p>
                </div>

                <div>
                    <div style="margin-bottom: 15px;">
                        @if($table->status === 'available')
                            <span class="badge badge-success" style="display: inline-block; width: 100%; text-align: center;">Disponible (Libre)</span>
                        @elseif($table->status === 'occupied')
                            <span class="badge badge-danger" style="display: inline-block; width: 100%; text-align: center;">Ocupada</span>
                        @elseif($table->status === 'reserved')
                            <span class="badge badge-warning" style="display: inline-block; width: 100%; text-align: center;">Reservada</span>
                        @endif
                    </div>

                    @if($table->status === 'available')
                        <a href="{{ route('waiter.orders.create', ['restTable' => $table->id]) }}" class="btn btn-primary" style="display: block; text-align: center; text-decoration: none;">
                            🔑 Abrir Mesa
                        </a>
                    @elseif($table->status === 'occupied')
                        <a href="{{ route('waiter.orders.show', ['restTable' => $table->id]) }}" class="btn btn-warning" style="display: block; text-align: center; text-decoration: none; color: #000;">
                            📝 Gestionar Pedido
                        </a>
                    @else
                        <button class="btn btn-secondary" style="display: block; width: 100%; cursor: not-allowed;" disabled>
                            🔒 Bloqueada
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; color: #777; padding: 40px; background: #fff; border: 1px dashed #ccc; border-radius: 8px;">
                No hay mesas dadas de alta en el sistema para mostrar en el salón.
            </div>
        @endforelse
    </div>
@endsection