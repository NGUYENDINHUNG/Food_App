<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Category extends Model
{
    protected $fillable = ['name', 'description', 'image', 'slug'];
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
    public function foods()
    {
        return $this->hasMany(Food::class);
    }

}
