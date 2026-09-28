<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreeNode extends Model
{
    protected $connection = 'oracle';

    protected $table = 'ERP_SYSTEM_TREE';

    public $timestamps = false;

    public $incrementing = true;

    protected $primaryKey = 'value';
    protected $keyType = 'int';

    protected $guarded = [];
}