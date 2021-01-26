<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'amount',
        'after_amount',
        'before_amount',
        'unitary_value',
        'total_value',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
