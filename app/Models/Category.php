<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Product;


class Category extends Model
{
    use HasFactory;

    public function categories():HasMany
    {
        return $this->hasMany(Category::class);
    }

    //Relación así misma
    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
