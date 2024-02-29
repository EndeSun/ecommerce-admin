<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Order;
use App\Models\User;

class Order_product extends Model
{
    use HasFactory;

    public function order(): BelongsTo{
        return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsToThrough(Order::class, User::class);
    }
}
