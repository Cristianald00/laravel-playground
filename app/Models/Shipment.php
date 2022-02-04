<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'order_id',
        'shipment_number',
        'shipment_date',
        'tracking_details',
        'note',
        'status'
    ];
}
