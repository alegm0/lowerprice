<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        try{
            $validateData = Validator::make($request->all(), [
                'name' => 'required|string',
                'unit_cost' => 'required',
                'quantity' => 'required|integer',
                'description' => 'nullable',
                'category_id' => 'required|integer|exists:categories,id',
                'user_id' => 'required|integer|exists:users,id',
            ]);
            if($validateData->fails()){
                return response()->json($validateData->errors(), 403);
            }else {
                $newProduct = new Product($request->all());
                $newProduct->save();
                return response()->json(['message' => 'Success operation', 'data' => $newProduct], 201);
            }
        }
        catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function index(int $id)
    {
        try{
            $validateData = Validator::make(['id' => $id],[
                'id' => 'required|integer|exists:product,id'
            ]);
            if($validateData->fails()){
                return response()->json($validateData->errors(), 403);
            } else {
                $products = Product::findOrFail($id);
                return response()->json(['message' => 'Success operation', 'data' => $products], 201);
            }
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function getList(int $userId)
    {
        try {
            if (!isset($userId)) {
                return response()->json('Send the parameter', 403);
            }
            $list = Product::where('user_id', $userId)->get();
            return response()->json(['message' => 'Success operation', 'data' => $list], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'name' => 'required|string',
                'unit_cost' => 'required',
                'quantity' => 'required|integer',
                'description' => 'nullable',
                'category_id' => 'required|integer|exists:categories,id',
                'user_id' => 'required|integer|exists:users,id',
            ]);
            if ($validateData->fails()) {
                return response()->json($validateData->errors(), 403);
            }
            Product::findOrFail($id)->update($request->all());
            $productUpdate = Product::findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $productUpdate], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function delete(int $id)
    {
        try {
            $validateData = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:product,id'
            ]);
            if ($validateData->fails()) {
                return response()->json($validateData->errors(), 403);
            }
            Product::findOrFail($id)->delete();
            return response()->json(['message' => 'Success operation', 'data' => 'OK'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
