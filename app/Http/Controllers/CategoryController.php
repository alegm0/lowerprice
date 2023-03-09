<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Category();
        //$this->middleware('auth:api');
    }

    public function store(Request $request)
    {
       try {
            $validateData = Validator::make($request->all(), [
                'user_id' => 'required|integer|exists:users,id',
                'name' => 'required',
            ]);
            if($validateData->fails()){
                return response()->json($validateData->errors(), 403);
            }
            $createCategory = $this->model::create($request->all());
            return response()->json(['message' => 'Success operation', 'data' => $createCategory], 201);
       } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
       }
    }

    public function update(Request $request, string $id)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validateData->fails()) {
                return response()->json($validateData->errors(), 403);
            }
            $this->model::findOrFail($id)->update($request->all());
            $category = $this->model::findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function findByUser(string $userId)
    {
        try {
            if (!isset($userId)) {
                return response()->json('Send the parameter', 403);
            }
            $data = $this->model::where('user_id', $userId)->get();
            return response()->json(['message' => 'Success operation', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function delete(string $id)
    {
        try {
            $validateData = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:categories,id'
            ]);
            if ($validateData->fails()) {
                return response()->json($validateData->errors(), 403);
            }
            $this->model::findOrFail($id)->delete();
            return response()->json(['message' => 'Success operation', 'data' => 'OK'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }

    }
}
