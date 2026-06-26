<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'dish_id',
        'quantity',
        'price',
        'subtotal',
    ];

    /**
     * Relación: La línea de detalle pertenece a una cabecera de pedido.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relación: La línea de detalle hace referencia a un plato o bebida específica.
     */
    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}