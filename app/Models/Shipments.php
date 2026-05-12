<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    protected $fillable = [
        'tracking_number',
        'staff_name',
        'client_name',
        'client_address',
        'receiver_name',
        'receiver_address',
        'status',
    ];
}
