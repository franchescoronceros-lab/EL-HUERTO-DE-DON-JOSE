@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-warning">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i>
                        Editar Categoría
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('categories.update',$category->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ $category->name }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea
                                name="description"
                                class="form-control"
                                rows="4"
                                required>{{ $category->description }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end">

                            <a href="{{ route('categories.index') }}" class="btn btn-secondary me-2">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i>
                                Actualizar
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection