<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'postal_code',
        'city_id',
        'country_id',
        'department_id',
        'name',
        'user_id'
    ];

    public function Department()
    {
        return $this->belongsTo(Departments::class);
    }

    public function City()
    {
        return $this->belongsTo(Cities::class);
    }

    public function Country()
    {
        return $this->belongsTo(Countries::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
