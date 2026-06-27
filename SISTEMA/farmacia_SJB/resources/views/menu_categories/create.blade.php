@extends('layouts.app')

@section('title', 'Nueva Categoría - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>➕ Nueva Categoría del Menú</h2>
    </div>

    <form action="{{ route('menu-categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre de la Categoría:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ej. Entradas, Platos de Fondo, Bebidas">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descripción (Opcional):</label>
            <textarea id="description" name="description" placeholder="Breve descripción del grupo de platos...">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="display_order">Orden de Visualización:</label>
            <input type="number" id="display_order" name="display_order" value="{{ old('display_order', 1) }}" min="1">
            @error('display_order')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_active">Estado Inicial:</label>
            <select id="is_active" name="is_active">
                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Activo (Visible en el menú)</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactivo (Oculto)</option>
            </select>
            @error('is_active')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="actions">
            <a href="{{ route('menu-categories.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar Categoría</button>
        </div>
    </form>
@endsection