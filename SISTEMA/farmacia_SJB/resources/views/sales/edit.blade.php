@extends('TEMPLATES.administrador')

@section('content')

<div class="container-fluid p-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i>
                        Editar Pedido
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('sales.update',$sale->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">Cliente</label>

                            <select name="customer_id" class="form-select" required>

                                @foreach($customers as $customer)

                                    <option
                                        value="{{ $customer->id }}"
                                        {{ $sale->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Plato</label>

                            <select name="medicine_id" class="form-select" required>

                                @foreach($medicines as $medicine)

                                    <option
                                        value="{{ $medicine->id }}"
                                        {{ $sale->details->first()->medicine_id == $medicine->id ? 'selected' : '' }}>
                                        {{ $medicine->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Cantidad</label>

                            <input
                                type="number"
                                class="form-control"
                                name="amount"
                                value="{{ $sale->details->first()->amount }}"
                                required>

                        </div>

                        <div class="text-end">

                            <a href="{{ route('sales.index') }}"
                               class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button class="btn btn-warning">
                                <i class="bi bi-save"></i>
                                Actualizar Pedido
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection