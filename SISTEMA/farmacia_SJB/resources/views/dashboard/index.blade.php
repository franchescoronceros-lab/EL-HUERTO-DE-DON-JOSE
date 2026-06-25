@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <h2 class="fw-bold">Panel de Control</h2>
    <p class="text-muted">
        Bienvenido al sistema de gestión del restaurante <strong>El Huerto de Don José</strong>.
    </p>

    <div class="row mt-4">

        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill fs-1 text-success"></i>
                    <h6 class="mt-2">Clientes</h6>
                    <h2>{{ $totalClientes }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-tags-fill fs-1 text-primary"></i>
                    <h6 class="mt-2">Categorías</h6>
                    <h2>{{ $totalCategorias }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-egg-fried fs-1 text-warning"></i>
                    <h6 class="mt-2">Platos</h6>
                    <h2>{{ $totalPlatos }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-receipt-cutoff fs-1 text-danger"></i>
                    <h6 class="mt-2">Pedidos</h6>
                    <h2>{{ $totalPedidos }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-8 col-12 mb-3">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body text-center">
                    <i class="bi bi-cash-stack fs-1"></i>
                    <h6 class="mt-2">Ventas Totales</h6>
                    <h2>S/. {{ number_format($ventasTotales,2) }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header">
            <strong>Estado del Sistema</strong>
        </div>

        <div class="card-body">

            <div class="row text-center">

                <div class="col-md-3">
                    <h5 class="text-success">✔ Clientes</h5>
                    <small>Operativo</small>
                </div>

                <div class="col-md-3">
                    <h5 class="text-success">✔ Platos</h5>
                    <small>Operativo</small>
                </div>

                <div class="col-md-3">
                    <h5 class="text-success">✔ Pedidos</h5>
                    <small>Operativo</small>
                </div>

                <div class="col-md-3">
                    <h5 class="text-success">✔ Inventario</h5>
                    <small>Operativo</small>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection