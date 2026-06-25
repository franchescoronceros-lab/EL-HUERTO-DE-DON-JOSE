<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $table = 'medicines';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}