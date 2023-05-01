<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
        'is_active',
        'company_id',
        'user_id'
    ];

}
