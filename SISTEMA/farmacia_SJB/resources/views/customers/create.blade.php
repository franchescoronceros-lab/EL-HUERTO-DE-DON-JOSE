@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-person-plus"></i>
                        Registrar Cliente
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('customers.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="address" class="form-control">
                        </div>

                        <div class="d-flex justify-content-end">

                            <a href="{{ route('customers.index') }}" class="btn btn-secondary me-2">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i>
                                Guardar Cliente
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection