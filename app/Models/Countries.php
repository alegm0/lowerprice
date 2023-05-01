<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'cade'];

    public function Department()
    {
        return $this->belongsTo(Departments::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }
}

