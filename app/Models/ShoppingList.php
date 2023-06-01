<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;

    protected $table = 'shopping_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_list',
        'start_date',
        'is_active',
        'estimated_price',
        'user_id'
    ];

    protected $casts = [
        'name_list' => 'string',
        'start_date' => 'date',
        'is_active' => 'boolean',
        'estimated_price' => 'float',
        'user_id' => 'integer'
    ];

    public function shoppingListProducts()
    {
        return $this->hasMany(ShoppingListsProducts::class);
    }
}
