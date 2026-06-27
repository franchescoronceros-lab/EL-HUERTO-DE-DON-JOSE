@extends('layouts.app')

@section('title', 'Gestionar Pedido - El Huerto de Don José')

@section('content')
    <div class="header">
        <h2>📝 Control de Comanda: {{ $restTable->table_number }}</h2>
        <a href="{{ route('waiter.index') }}" class="btn btn-secondary" style="text-decoration: none;">⬅️ Volver al Salón</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 20px;">
        
        <div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); height: fit-content;">
            <h3 style="margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 10px; color: #333;">🍔 Añadir al Pedido</h3>
            
            <form action="{{ route('waiter.orders.add_dish', ['restTable' => $restTable->id]) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="dish_id">Seleccionar Ítem del Menú:</label>
                    <select id="dish_id" name="dish_id" required style="width: 100%; padding: 8px;">
                        <option value="">-- Elige un plato o bebida --</option>
                        @foreach($dishes as $dish)
                            <option value="{{ $dish->id }}">
                                {{ $dish->name }} (S/. {{ number_format($dish->price, 2) }})
                            </option>
                        @endforeach
                    </select>
                    @error('dish_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity">Cantidad:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="20" required style="width: 100%; padding: 8px;">
                    @error('quantity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">
                    ➕ Agregar a la Mesa
                </button>
            </form>
        </div>

        <div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 15px;">
                <h3 style="margin: 0; color: #333;">🛒 Estado de Cuenta Actual</h3>
                <span class="badge badge-info">{{ $order->invoice_number }}</span>
            </div>

            <p style="margin: 0 0 15px 0; font-size: 0.95em;">
                👤 <strong>Cliente / Referencia:</strong> {{ $order->customer_name }} <br>
                🕒 <strong>Apertura:</strong> {{ $order->created_at->format('d/m/Y h:i A') }}
            </p>

            <table class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                        <th style="padding: 10px; text-align: left;">Descripción</th>
                        <th style="padding: 10px; text-align: center;">Cant.</th>
                        <th style="padding: 10px; text-align: right;">P. Unit.</th>
                        <th style="padding: 10px; text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->details as $detail)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px; text-align: left;">{{ $detail->dish->name }}</td>
                            <td style="padding: 10px; text-align: center;">{{ $detail->quantity }}</td>
                            <td style="padding: 10px; text-align: right;">S/. {{ number_format($detail->price, 2) }}</td>
                            <td style="padding: 10px; text-align: right; font-weight: bold;">S/. {{ number_format($detail->subtotal, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #888; padding: 30px;">
                                La comanda está vacía. Selecciona platos a la izquierda para empezar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="width: 50%; margin-left: auto; background: #f8f9fa; padding: 15px; border-radius: 6px; border: 1px solid #eee;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span>Subtotal:</span>
                    <span>S/. {{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; color: #666; font-size: 0.9em;">
                    <span>IGV ({{ number_format($order->igv_percentage, 0) }}%):</span>
                    <span>S/. {{ number_format($order->igv, 2) }}</span>
                </div>
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 8px 0;">
                <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 1.2em; color: #333;">
                    <span>Total a Pagar:</span>
                    <span>S/. {{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

    </div>
@endsection