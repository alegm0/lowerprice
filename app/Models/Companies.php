<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\Companies as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Companies extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'companies';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'document_number' => 'integer',
        'phone' => 'integer',
        'email' => 'string',
        'password' => 'string',
        'website' => 'string',
        'size_company' => 'string',
        'is_active' => 'bool',
        'address_description' => 'string',
        'city_id' => 'integer',
        'country_id' => 'integer',
        'department_id' => 'integer',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'document_number',
        'phone',
        'email',
        'password',
        'website',
        'size_company',
        'is_active',
        'address_description',
        'city_id',
        'country_id',
        'department_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function paymentMethods(): BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class, 'companies_payment_methods', 'company_id', 'payment_method_id');
    }

    public function Discount()
    {
        return $this->hasMany(DiscountPromotions::class);
    }
}
