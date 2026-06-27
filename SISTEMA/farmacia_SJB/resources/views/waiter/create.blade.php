@extends('layouts.app')

@section('title', 'Abrir Mesa - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>🔑 Apertura de Mesa: {{ $restTable->table_number }}</h2>
    </div>

    <div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <p style="margin: 0 0 10px 0;">📍 <strong>Ubicación/Área:</strong> 
            @switch($restTable->location)
                @case('main_hall') Salón Principal @break
                @case('terrace') Terraza @break
                @case('bar') Barra de Tragos @break
                @case('delivery') Área Delivery / Llevar @break
                @default {{ $restTable->location }}
            @endswitch
        </p>
        <p style="margin: 0;">👥 <strong>Capacidad Permitida:</strong> Hasta {{ $restTable->capacity }} personas.</p>
    </div>

    <form action="{{ route('waiter.orders.store', ['restTable' => $restTable->id]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="customer_name">Nombre del Cliente o Referencia (Opcional):</label>
            <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Ej: Familia García / Pareja Ventanilla / Solo">
            <small style="color: #666; display: block; margin-top: 5px;">Si se deja en blanco, el sistema registrará la orden automáticamente como "Clientes Varios".</small>
            @error('customer_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="actions" style="margin-top: 25px;">
            <a href="{{ route('waiter.index') }}" class="btn btn-secondary" style="margin-right: 10px; text-decoration: none; display: inline-block; text-align: center;">
                Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                Iniciar Comanda / Ocupar Mesa
            </button>
        </div>
    </form>
@endsection