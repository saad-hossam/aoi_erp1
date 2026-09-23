<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category_id',
        'brand_id',
        'image',
        'images',
        'SKU',
        'stock_status',
        'featured',
        'quantity',
        'short_description',
        'regular_price',
        'sale_price',
        'created_at',
        'updated_at'

    ];
// Product.php
protected $casts = [
    'images' => 'array',
];


    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);

}
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
    public function colors()
{
    return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
}

}

