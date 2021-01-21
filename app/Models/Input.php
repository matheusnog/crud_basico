<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'amount',
        'after_amount',
        'before_amount',
        'date',
        'unitary_value',
        'total_value',
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
