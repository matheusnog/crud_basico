<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'current_amount',
    ];

    public function inputs()
    {
        return $this->hasMany(Input::class);
    }

    public function saleProducts()
    {
        return $this->hasMany(SaleProduct::class);
    }
}
