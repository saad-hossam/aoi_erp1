<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TreePageMapping extends Model
{
    protected $connection = 'oracle';

    protected $table = 'ERP_TREE_PAGE_MAPPINGS';

    protected $fillable = [
        'tree_value',
        'page_id',
    ];

    protected $casts = [
        'tree_value' => 'integer',
        'page_id' => 'integer',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}