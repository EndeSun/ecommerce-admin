<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /* Relación muchos a uno */
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function orders_product(): HasMany{
        return $this->hasMany(Order_product::class);
    }
}
