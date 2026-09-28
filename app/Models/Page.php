<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model
{
    protected $connection = 'oracle';

    protected $table = 'ERP_PAGES';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'component',
        'controller',
        'route_name',
        'route_path',
        'status',
    ];

    public function mapping(): HasOne
    {
        return $this->hasOne(TreePageMapping::class);
    }
}