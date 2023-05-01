<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    protected $fillable = [
        'name',
        'code',
        'description'
    ];

    protected $casts = [
        'name' => 'string',
        'code' => 'string',
        'description' => 'double'
    ];

    public function company()
    {
        return $this->belongsToMany(Companies::class, 'companies_payment_methods', 'payment_method_id', 'company_id');
    }
}
