<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function findByEmail(string $email)
    {
        return $this->model::where('email', $email)->first();
    }
}
