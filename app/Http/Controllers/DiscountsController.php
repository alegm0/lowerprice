<?php

namespace App\Http\Controllers;

use App\Models\Discounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountsController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Discounts();
        //$this->middleware('auth:api');
    }

    public function store(Request $request)
    {
       try {
            $validateData = Validator::make($request->all(), [
                'product_id' => 'required|integer|exists:product,id',
                'value' => 'required',
                'min_quantity' => 'required|integer',
                'max_quantity' => 'required|integer',
            ]);
            if($validateData->fails()){
                return response()->json($validateData->errors(), 403);
            }
            $createDiscounts = $this->model::create($request->all());
            return response()->json(['message' => 'Success operation', 'data' => $createDiscounts], 201);
       } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
       }
    }

    public function update(Request $request, string $id)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'product_id' => 'required|integer|exists:product,id',
                'value' => 'required',
                'min_quantity' => 'required|integer',
                'max_quantity' => 'required|integer',
            ]);
            if ($validateData->fails()) {
                return response()->json($validateData->errors(), 403);
            }
            $this->model::findOrFail($id)->update($request->all());
            $discounts = $this->model::findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $discounts], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function findByProduct(string $productId)
    {
        try {
            if (!isset($productId)) {
                return response()->json('Send the parameter', 403);
            }
            $data = $this->model::where('product_id', $productId)->get();
            return response()->json(['message' => 'Success operation', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function delete(string $id)
    {
        try {
            $validateData = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:discounts,id'
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
