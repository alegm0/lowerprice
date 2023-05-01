<?php

namespace App\Http\Controllers;

use App\Models\Brands;

class BrandsController extends Controller
{
    protected $model;

    public function __construct()
    {
        //$this->middleware('auth:api');
        $this->model = new Brands();
    }

    public function getAll()
    {
        return $this->model::all();
    }
}
