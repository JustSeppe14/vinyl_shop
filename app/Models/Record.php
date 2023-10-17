<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

//    protected function genreName(): Attribute
//    {
//        return Attribute::make(
//            get: fn($value, $attributes) => Genre::find($attributes['genre_id'])->name,
//        );
//    }

//    protected $appends = ['genre_name'];

    protected function priceEuro(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) =>  '€ ' . number_format($attributes['price'],2),
        );
    }
    protected $appends = ['genre_name', 'price_euro'];

    public function genre()
    {
        return $this->belongsTo(Genre::class)->withDefault(); //a record belongs to a "genre"
    }
}
