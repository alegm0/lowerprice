<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingListsProducts extends Model
{
    use HasFactory;

    protected $table = 'shopping_lists_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'shopping_list_id',
        'product_id',
        'total_cost'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'shopping_list_id' => 'string',
        'product_id' => 'string',
        'total_cost' => 'integer'
    ];

    public function ShoppingList()
    {
        return $this->belongsTo(ShoppingList::class);
    }

    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
