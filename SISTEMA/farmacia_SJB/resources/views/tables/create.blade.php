@extends('layouts.app')

@section('title', 'Nueva Mesa - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>➕ Registrar Nueva Mesa en el Salón</h2>
    </div>

    <form action="{{ route('tables.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="table_number">Código / Número de Mesa:</label>
            <input type="text" id="table_number" name="table_number" value="{{ old('table_number') }}" placeholder="Ej: Mesa 01, Barra 03, Terraza A">
            @error('table_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="capacity">Capacidad Máxima (Personas):</label>
            <input type="number" id="capacity" name="capacity" value="{{ old('capacity', 4) }}" min="1" max="50">
            @error('capacity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="location">Zona / Ubicación del Local:</label>
            <select id="location" name="location">
                <option value="main_hall" {{ old('location') == 'main_hall' ? 'selected' : '' }}>Salón Principal</option>
                <option value="terrace" {{ old('location') == 'terrace' ? 'selected' : '' }}>Terraza</option>
                <option value="bar" {{ old('location') == 'bar' ? 'selected' : '' }}>Barra de Tragos</option>
                <option value="delivery" {{ old('location') == 'delivery' ? 'selected' : '' }}>Área Delivery / Llevar</option>
            </select>
            @error('location')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Estado Inicial de Operación:</label>
            <select id="status" name="status">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Disponible (Libre para Comensales)</option>
                <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Ocupada (Con Comanda Activa)</option>
                <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Reservada (Bloqueada)</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="actions">
            <a href="{{ route('tables.index') }}" class="btn btn-secondary" style="margin-right: 10px;">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Mesa</button>
        </div>
    </form>
@endsection