<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountPromotions extends Model
{
    use HasFactory;

    protected $table = 'discount_promotions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date',
        'finish_date',
        'value',
        'conditions',
        'is_active',
        'product_id',
        'company_id'
    ];

    public function Companies()
    {
        return $this->belongsTo(Companies::class);
    }
}
