<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restaurant_name',
        'ruc',
        'address',
        'phone',
        'igv_percentage',
        'logo_path',
        'facebook_url',
        'instagram_url',
        'receipt_footer',
    ];
}