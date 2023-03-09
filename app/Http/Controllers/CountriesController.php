<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Countries();
    }

    public function find()
    {
        try {
            $data = $this->model::all();
            return response()->json(['message' => 'Success operation', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
