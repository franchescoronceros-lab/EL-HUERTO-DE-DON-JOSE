@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold">Gestión de Clientes</h2>
            <p class="text-muted">
                Listado general de clientes registrados en la base de datos.
            </p>
        </div>

        <a href="#" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Nuevo cliente
        </a>
    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Clientes</strong>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de registro</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($customers as $customer)

                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->created_at }}</td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No hay clientes registrados.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection