<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    // You can add relationships if needed, e.g., products that have this size
    public function products()
    {
        return $this->belongsToMany(Product::class);

}
}
