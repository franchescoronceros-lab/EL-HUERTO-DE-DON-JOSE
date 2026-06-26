<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'display_order',
        'is_active',
    ];

    /**
     * Relación: Una categoría agrupa a múltiples platos y bebidas.
     */
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}