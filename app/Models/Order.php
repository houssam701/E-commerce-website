<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    protected $table='orders';
    use HasFactory;
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}