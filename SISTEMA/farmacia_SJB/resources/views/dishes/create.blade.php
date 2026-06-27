@extends('layouts.app')

@section('title', 'Nuevo Plato - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>➕ Registrar Nuevo Plato o Bebida</h2>
    </div>

    <form action="{{ route('dishes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre del Plato / Bebida:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ej. Lomo Saltado, Chicha Morada 1L">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="menu_category_id">Categoría del Menú:</label>
            <select id="menu_category_id" name="menu_category_id">
                <option value="">-- Seleccione una Categoría --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('menu_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('menu_category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descripción / Ingredientes (Opcional):</label>
            <textarea id="description" name="description" placeholder="Ej. Carne de res picada, cebolla, tomate, papas fritas, acompañado de arroz..."></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 15px;">
            <div class="form-group" style="flex: 1;">
                <label for="price">Precio de Venta (S/.):</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0.00" placeholder="0.00">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="flex: 1;">
                <label for="stock">Stock Inicial (Cocina / Barra):</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0">
                @error('stock')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="is_active">Estado Inicial:</label>
            <select id="is_active" name="is_active">
                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Disponible (Visible en carta)</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Agotado (Oculto temporalmente)</option>
            </select>
            @error('is_active')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="actions">
            <a href="{{ route('dishes.index') }}" class="btn btn-secondary" style="margin-right: 10px;">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Plato</button>
        </div>
    </form>
@endsection