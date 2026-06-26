<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dish extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'is_active',
    ];

    /**
     * Relación: Un plato pertenece a una categoría del menú.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    /**
     * Relación: Un plato puede aparecer en múltiples líneas de detalle de pedidos.
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}