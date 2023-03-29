<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Companies();
    }

    public function findByEmail(string $email)
    {
        return $this->model::where('email', $email)->first();
    }
}
