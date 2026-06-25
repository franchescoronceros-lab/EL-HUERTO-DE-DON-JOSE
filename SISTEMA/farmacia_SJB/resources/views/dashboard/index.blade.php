@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <h2 class="fw-bold">Panel de Control</h2>
    <p class="text-muted">Resumen general del restaurante El Huerto de Don José.</p>

    <div class="row mt-4">

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-1 text-success"></i>
                    <h6 class="mt-2">Clientes</h6>
                    <h2>{{ $totalClientes }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-tags fs-1 text-primary"></i>
                    <h6 class="mt-2">Categorías</h6>
                    <h2>{{ $totalCategorias }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-egg-fried fs-1 text-warning"></i>
                    <h6 class="mt-2">Platos</h6>
                    <h2>{{ $totalPlatos }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-receipt fs-1 text-danger"></i>
                    <h6 class="mt-2">Pedidos</h6>
                    <h2>{{ $totalPedidos }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection