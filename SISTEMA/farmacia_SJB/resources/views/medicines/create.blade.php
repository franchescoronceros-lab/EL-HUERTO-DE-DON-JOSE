@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-egg-fried"></i>
                        Registrar Plato
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('medicines.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Categoría</label>

                            <select name="category_id" class="form-select" required>

                                <option value="">Seleccione...</option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre del plato</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <label class="form-label">Precio</label>

                                <input type="number"
                                       step="0.01"
                                       name="price"
                                       class="form-control"
                                       required>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label">Stock</label>

                                <input type="number"
                                       name="stock"
                                       class="form-control"
                                       required>

                            </div>

                        </div>

                        <div class="mt-4 text-end">

                            <a href="{{ route('medicines.index') }}"
                               class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button class="btn btn-success">
                                <i class="bi bi-save"></i>
                                Guardar Plato
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection