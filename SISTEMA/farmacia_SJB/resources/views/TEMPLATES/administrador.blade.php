<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante | El Huerto de Don José</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .menu-link{color:#495057;text-decoration:none;padding:10px 15px;border-radius:8px;display:block;margin-bottom:5px}
        .menu-link:hover,.menu-link.active{background-color:#198754;color:white}
        .text-main{color:#198754}
        .badge-main{background-color:#198754}
    </style>
</head>
<body>
<div class="row g-0">
    <aside class="col-md-3 col-lg-2 bg-white border-end min-vh-100">
        <div class="p-3">
            <h4 class="fw-bold text-main small text-center text-uppercase">El Huerto de Don José</h4>
            <hr>

            <div class="text-center mb-4">
                <div style="width:100px;height:100px;background:#d9ead3;border-radius:50%;margin:auto;display:flex;align-items:center;justify-content:center;font-size:40px;">
                    🍽️
                </div>
                <h6 class="mt-2">Administrador</h6>
                <span class="badge badge-main">Restaurante</span>
            </div>

            <h6 class="text-muted fw-bold">PRINCIPAL</h6>
            <nav>
                <a href="{{ route('dashboard.index') }}" class="menu-link active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                <a href="#" class="menu-link"><i class="bi bi-gear me-2"></i>Configuraciones</a>
                <a href="#" class="menu-link"><i class="bi bi-bar-chart me-2"></i>Reportes</a>
            </nav>

            <h6 class="text-muted fw-bold mt-3">GESTIÓN</h6>
            <nav>
                <a href="{{ route('customer.index') }}" class="menu-link"><i class="bi bi-people me-2"></i>Clientes</a>
                <a href="{{ route('medicines.index') }}" class="menu-link"><i class="bi bi-egg-fried me-2"></i>Platos</a>
                <a href="{{ route('sales.index') }}" class="menu-link"><i class="bi bi-receipt me-2"></i>Pedidos</a>
                <a href="{{ route('categories.index') }}" class="menu-link"><i class="bi bi-tags me-2"></i>Categorías de menú</a>
            </nav>
        </div>
    </aside>

    <main class="col-md-9 col-lg-10 bg-light min-vh-100">
        <nav class="navbar navbar-expand-lg bg-white border-bottom px-4">
            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="#" class="btn btn-outline-secondary position-relative">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-danger small">3</span>
                </a>
                <button class="btn btn-success dropdown-toggle">Franchesco Ronceros</button>
            </div>
        </nav>

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>