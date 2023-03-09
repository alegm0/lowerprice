<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'name', 'cade'];

    public function Country()
    {
        return $this->hasMany(Countries::class);
    }

    public function City()
    {
        return $this->belongsTo(Cities::class);
    }
}
