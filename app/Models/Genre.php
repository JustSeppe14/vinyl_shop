<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Genre extends Model
{
    use HasFactory;

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value)=>ucfirst($value),
            set: fn($value)=>strtolower($value),
        );
    }

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at','updated_at'];

    public function records()
    {
        return $this->hasMany(Record::class); // a genre has many "records"
    }
}
