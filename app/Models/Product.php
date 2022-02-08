<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'name',
        'identifier',
        'batch_number',
        'inventory_id',
        'quantity',
        'price',
        'cost',
        'reorder_point',
        'active',
        'description'
    ];

    protected $dates = [
        'created_at',
        'updated_at'];

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    public function product_image(){
        return $this->hasMany(ProductImage::class);
    }

    public function order(){
        return $this->belongsToMany(Order::class, 'order_number')->withPivot('quantity', 'price', 'cost');
    }

    public function shipment(){
        return $this->hasMany(Shipment::class);
    }
    public function getProducts() {
        return $this->with('inventory')
            ->get()->map(function ($product){
                return $product->format();
            });
    }
    public function format()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'batch_number' => $this->batch_number,
            'inventory_id' => $this->inventory_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'cost' => $this->cost,
            'reorder_point' => $this->reorder_point,
            'active' => $this->active,
            'description' => $this->description,
            'inventory' => $this->inventory->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->created_at,
        ];
    }
}
