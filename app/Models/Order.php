<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'identifier',
        'order_number',
        'order_date',
        'shipment_date',
        'arrival_date',
        'note',
        'status'
    ];
}
