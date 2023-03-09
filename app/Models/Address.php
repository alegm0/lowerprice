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
    protected $fillable = ['description', 'postal_code', 'city_id', 'country_id', 'department_id', 'sector', 'name', 'user_id'];

    public function Department()
    {
        return $this->hasMany(Departments::class);
    }

    public function City()
    {
        return $this->hasMany(Cities::class);
    }

    public function Country()
    {
        return $this->hasMany(Countries::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
