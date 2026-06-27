@extends('layouts.app')

@section('title', 'Editar Categoría - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>📝 Editar Categoría: {{ $menuCategory->name }}</h2>
    </div>

    <form action="{{ route('menu-categories.update', $menuCategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre de la Categoría:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $menuCategory->name) }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descripción (Opcional):</label>
            <textarea id="description" name="description">{{ old('description', $menuCategory->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="display_order">Orden de Visualización:</label>
            <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $menuCategory->display_order) }}" min="1">
            @error('display_order')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_active">Estado:</label>
            <select id="is_active" name="is_active">
                <option value="1" {{ old('is_active', $menuCategory->is_active) == '1' ? 'selected' : '' }}>Activo (Visible)</option>
                <option value="0" {{ old('is_active', $menuCategory->is_active) == '0' ? 'selected' : '' }}>Inactivo (Oculto)</option>
            </select>
            @error('is_active')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="actions">
            <a href="{{ route('menu-categories.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-warning">Actualizar Categoría</button>
        </div>
    </form>
@endsection