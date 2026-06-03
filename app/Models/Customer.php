<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    /**
     * 一括代入許可
     */
    protected $fillable = [
        'name',
        'login_id',
        'password',
    ];
}
