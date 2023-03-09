<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value', 'min_quantity', 'max_quantity', 'product_id'];

    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
