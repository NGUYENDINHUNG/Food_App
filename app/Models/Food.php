<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = ['name', 'description', 'slug', 'image', 'price', 'category_id', 'quantity'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
