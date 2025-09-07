<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = ['name', 'description', 'slug', 'image', 'price', 'category_id', 'quantity'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
