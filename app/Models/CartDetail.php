<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $fillable = ['cart_id', 'food_id', 'quantity', 'unit_price'];
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
