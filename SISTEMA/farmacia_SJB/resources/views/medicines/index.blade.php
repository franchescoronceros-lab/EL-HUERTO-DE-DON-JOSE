@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h2 class="fw-bold">Gestión de Platos</h2>
            <p class="text-muted">
                Listado general de platos registrados en el restaurante.
            </p>
        </div>

        <a href="{{ route('medicines.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i>
            Nuevo plato
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Platos</strong>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-success">

                    <tr>
                        <th>ID</th>
                        <th>Categoría</th>
                        <th>Plato</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($medicines as $medicine)

                    <tr>

                        <td>{{ $medicine->id }}</td>

                        <td>
                            {{ $medicine->category->name ?? '-' }}
                        </td>

                        <td>{{ $medicine->name }}</td>

                        <td>S/. {{ number_format($medicine->price,2) }}</td>

                        <td>{{ $medicine->stock }}</td>

                        <td width="130">

                            <a href="{{ route('medicines.edit',$medicine->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('medicines.destroy',$medicine->id) }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar este plato?')">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">
                            No existen platos registrados.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection