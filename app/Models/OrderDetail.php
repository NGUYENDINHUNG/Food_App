<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'food_id', 'quantity', 'unit_price', 'total_price', 'note'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
