<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function orderlines()
    {
        return $this->hasMany(Orderline::class); // an order has many orderlines
    }

    public function user()
    {
        return $this->belongsTo(User::class); // an order has one user
    }
}
