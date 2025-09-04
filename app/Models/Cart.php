<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'carts_detail');
    }
    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }
}
