<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'unit_cost', 'quantity', 'description', 'category_id', 'user_id'];

    public function Discounts()
    {
        return $this->belongsTo(Discounts::class);
    }

    public function Category()
    {
        return $this->hasMany(Category::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
