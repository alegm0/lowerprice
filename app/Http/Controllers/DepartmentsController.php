<?php

namespace App\Http\Controllers;

use App\Models\Departments;

class DepartmentsController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Departments();
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
