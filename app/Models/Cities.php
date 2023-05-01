<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['department_id', 'name', 'cade'];

    public function Department()
    {
        return $this->hasMany(Departments::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
