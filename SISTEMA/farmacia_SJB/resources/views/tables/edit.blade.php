@extends('layouts.app')

@section('title', 'Editar Mesa - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>📝 Modificar Configuración: {{ $restTable->table_number }}</h2>
    </div>

    <form action="{{ route('tables.update', ['restTable' => $restTable->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="table_number">Código / Número de Mesa:</label>
            <input type="text" id="table_number" name="table_number" value="{{ old('table_number', $restTable->table_number) }}">
            @error('table_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="capacity">Capacidad Máxima (Personas):</label>
            <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $restTable->capacity) }}" min="1" max="50">
            @error('capacity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="location">Zona / Ubicación del Local:</label>
            <select id="location" name="location">
                <option value="main_hall" {{ old('location', $restTable->location) == 'main_hall' ? 'selected' : '' }}>Salón Principal</option>
                <option value="terrace" {{ old('location', $restTable->location) == 'terrace' ? 'selected' : '' }}>Terraza</option>
                <option value="bar" {{ old('location', $restTable->location) == 'bar' ? 'selected' : '' }}>Barra de Tragos</option>
                <option value="delivery" {{ old('location', $restTable->location) == 'delivery' ? 'selected' : '' }}>Área Delivery / Llevar</option>
            </select>
            @error('location')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Estado Operativo Actual:</label>
            <select id="status" name="status">
                <option value="available" {{ old('status', $restTable->status) == 'available' ? 'selected' : '' }}>Disponible (Libre)</option>
                <option value="occupied" {{ old('status', $restTable->status) == 'occupied' ? 'selected' : '' }}>Ocupada (Con Comanda Activa)</option>
                <option value="reserved" {{ old('status', $restTable->status) == 'reserved' ? 'selected' : '' }}>Reservada (Bloqueada)</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="actions">
            <a href="{{ route('tables.index') }}" class="btn btn-secondary" style="margin-right: 10px;">Cancelar</a>
            <button type="submit" class="btn btn-warning">Actualizar Mesa</button>
        </div>
    </form>
@endsection