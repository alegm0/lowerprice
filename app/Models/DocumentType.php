<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $table = 'document_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'description', 'name'];

    protected $casts = [
        'id' => 'string',
        'description' => 'string',
        'name' => 'string',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
