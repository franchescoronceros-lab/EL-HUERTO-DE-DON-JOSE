@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold">Gestión de Categorías</h2>
            <p class="text-muted">
                Listado general de categorías registradas en la base de datos.
            </p>
        </div>

        <a href="#" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Nueva categoría
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Categorías</strong>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de registro</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($categories as $category)

                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->created_at }}</td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No hay categorías registradas.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection