<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'name',
        'batch_number',
        'quantity'
    ];

    // ===================== ORM Definition START ===================== //

    public function parent() {
        return $this->belongsTo(Inventory::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Inventory::class, 'parent_id');
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function format(){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'batch_number' => $this->batch_number,
            'products' => $this->products->map(function ($product){
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'identifier' => $product->identifier,
                    'batch_number' => $product->batch_number,
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                    'cost' => $product->cost,
                    'reorder_point' => $product->reorder_point,
                    'active' => $product->active,
                    'description' => $product->description,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->created_at,
                ];
            }),
            'quantity' => $this->products->count(function ($product){
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'identifier' => $product->identifier,
                    'batch_number' => $product->batch_number,
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                    'cost' => $product->cost,
                    'reorder_point' => $product->reorder_point,
                    'active' => $product->active,
                    'description' => $product->description,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->created_at,
                ];
            }),
        ];
    }
}


