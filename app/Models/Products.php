<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'unit_cost',
        'brand_id',
        'category_id',
        'creator_id',
        'type',
        'id_api'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'unit_cost' => 'double',
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'creator_id' => 'integer',
        'type' => 'string',
        'id_api' => 'string'
    ];

    public function Category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function Brand()
    {
        return $this->belongsTo(Brands::class);
    }

    public function ShoppingListsProducts()
    {
        return $this->hasMany(ShoppingListsProducts::class);
    }
}
