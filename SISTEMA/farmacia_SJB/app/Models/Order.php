<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_number',
        'user_id',
        'table_id',
        'customer_id',
        'customer_name',
        'subtotal',
        'igv_percentage',
        'igv',
        'total',
        'status',
        'payment_method',
    ];

    /**
     * Relación: El pedido pertenece al mozo/usuario que lo atendió.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: El pedido fue asignado a una mesa específica del restaurante.
     */
    public function restTable(): BelongsTo
    {
        return $this->belongsTo(RestTable::class, 'table_id');
    }

    /**
     * Relación: El pedido puede estar asociado a un cliente registrado (opcional).
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relación: Un pedido contiene muchas líneas de detalle con los platos pedidos.
     */
    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}