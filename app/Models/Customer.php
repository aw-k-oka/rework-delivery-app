<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    /**
     * 一括代入許可カラム
     */
    protected $fillable = [
        'name',
        'login_id',
        'password',
    ];

    /**
     * 外部キーを紐付け
     * @return HasMany
     */
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }
}
