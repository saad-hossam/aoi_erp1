<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * ERP_PROD.EMP – the employees table. This model is BOTH the login user
 * (Auth::user()) and the thing roles are assigned to (Spatie HasRoles →
 * model_has_roles.model_type = App\Models\Emp, model_id = EMP_NO).
 */
class Emp extends Authenticatable
{
    use HasRoles;

    protected $connection = 'oracle';
    protected $table = 'EMP';
    protected $primaryKey = 'EMP_NO';
    protected $keyType = 'int';
    public $incrementing = false;   // EMP_NO has no sequence – EmpController generates the next number
    public $timestamps = false;

    protected $guard_name = 'web';  // Spatie guard

    protected $fillable = [
        'EMP_NO', 'EMP_NAME', 'PASS_WORD', 'EMP_STATUS', 'USER_NAME', 'DEPT_CODE',
        'FILE_NO', 'SIGN_TYPE', 'REAL_DEPT', 'MGR', 'ADMIN',
    ];

    protected $hidden = ['PASS_WORD'];

    /** Oracle may hand column names back in lower or upper case – always work with UPPER. */
    public function setRawAttributes(array $attributes, $sync = false)
    {
        return parent::setRawAttributes(array_change_key_case($attributes, CASE_UPPER), $sync);
    }

    /* ---- Authenticatable: password lives in EMP.PASS_WORD, there is no remember_token ---- */
    public function getAuthPasswordName()
    {
        return 'PASS_WORD';
    }

    public function getAuthPassword()
    {
        return $this->attributes['PASS_WORD'] ?? null;
    }

    public function getRememberTokenName()
    {
        return '';
    }

    /** Lets old code / views that still say Auth::user()->name keep working. */
    public function getNameAttribute(): string
    {
        return trim((string) ($this->attributes['USER_NAME'] ?? $this->attributes['EMP_NAME'] ?? ('Employee '.$this->getKey())));
    }

    public function isAdmin(): bool
    {
        return (int) ($this->attributes['ADMIN'] ?? 0) === 1 || $this->hasRole('admin');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if ($term === null || trim($term) === '') {
            return $query;
        }

        $like = '%'.mb_strtoupper(trim($term)).'%';

        return $query->where(function ($q) use ($like) {
            $q->whereRaw('UPPER("USER_NAME") LIKE ?', [$like])
              ->orWhereRaw('UPPER("EMP_NAME") LIKE ?', [$like])
              ->orWhereRaw('CAST("EMP_NO" AS VARCHAR(20)) LIKE ?', [$like]);
        });
    }
}
