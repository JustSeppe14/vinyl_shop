<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;


class Record extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    protected function genreName(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attributes)=> Genre::find($attributes['genre_id'])->name,
        );
    }

    protected function priceEuro(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attributes) => '€ ' . number_format($attributes['price'],2)
        );
    }

    protected function cover(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $coverPath = 'covers/' . $attributes['mb_id'] . '.jpg';
                return (Storage::disk('public')->exists($coverPath))
                    ? Storage::url($coverPath)
                    : Storage::url('covers/no-cover.png');
            },
        );
    }

    protected $appends = ['genre_name','price_euro','cover'];

    public function scopeMaxPrice($query,$price = 100)
    {
        return $query->where('price','<=',$price);
    }



    public function genre()
    {
        return $this->belongsTo(Genre::class,'genre_id','id')->withDefault(); //a record belongs to a "genre"
    }
}
