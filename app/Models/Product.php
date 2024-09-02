<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory,Searchable;

    protected $fillable = ['price', 'name', 'description', 'quantity','type_id'];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function toSearchableArray(){
        return [
            'name' => $this->name,
            'description' =>$this->description,
        ];
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function firstImage()
    {
        return $this->hasOne(ProductImage::class)->oldest();
    }
}