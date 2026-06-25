@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h2 class="fw-bold">Gestión de Pedidos</h2>
            <p class="text-muted">
                Listado general de pedidos registrados.
            </p>
        </div>

        <a href="{{ route('sales.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i>
            Nuevo pedido
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Pedidos</strong>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-success">

                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Plato</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>IGV</th>
                        <th>Fecha</th>
                        <th width="130">Acciones</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($sales as $sale)

                    <tr>

                        <td>{{ $sale->id }}</td>

                        <td>{{ $sale->customer->name }}</td>

                        <td>
                            {{ optional($sale->details->first())->medicine->name ?? '-' }}
                        </td>

                        <td>
                            {{ optional($sale->details->first())->amount ?? 0 }}
                        </td>

                        <td>S/. {{ number_format($sale->total,2) }}</td>

                        <td>S/. {{ number_format($sale->igv,2) }}</td>

                        <td>{{ $sale->created_at }}</td>

                        <td>

                            <a href="{{ route('sales.edit',$sale->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('sales.destroy',$sale->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar este pedido?')">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="text-center">
                            No existen pedidos registrados.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection