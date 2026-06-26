<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestTable extends Model
{
    use HasFactory;

    /**
     * Definición explícita de la tabla para mapear el modelo correctamente.
     *
     * @var string
     */
    protected $table = 'tables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'table_number',
        'capacity',
        'status',
        'location',
    ];

    /**
     * Relación: Una mesa del restaurante puede tener muchos pedidos a lo largo del tiempo.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'table_id');
    }
}