@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-cart-plus"></i>
                        Registrar Pedido
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Cliente</label>
                            <select name="customer_id" class="form-select" required>
                                <option value="">Seleccione...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Plato</label>
                            <select name="medicine_id" class="form-select" required>
                                <option value="">Seleccione...</option>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">
                                        {{ $medicine->name }} - S/. {{ number_format($medicine->price, 2) }} - Stock: {{ $medicine->stock }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cantidad</label>
                            <input type="number" name="amount" class="form-control" min="1" required>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button class="btn btn-success">
                                <i class="bi bi-save"></i>
                                Guardar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection