<?php

namespace App\Http\Controllers;

use App\Models\DiscountPromotions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountPromotionsController extends Controller
{
    protected $model;

    public function __construct()
    {
        //$this->middleware('auth:api');
        $this->model = new DiscountPromotions();
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'finish_date' => 'required',
                'value' => 'required',
                'conditions' => 'nullable',
                'product_id' => 'required|exists:products,id',
                'company_id' => 'required|exists:companies,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
            $discountPromotions = $this->model->create($request->all());
            return response()->json(['message' => 'Success operation', 'data' => $discountPromotions], 200);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'start_date' => 'required',
                'finish_date' => 'required',
                'value' => 'required',
                'conditions' => 'required',
                'product_id' => 'required|exists:products,id',
                'company_id' => 'required|exists:companies,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
            $this->model->findOrFail($id)->update($request->all());
            $discountPromotions =  $this->model->findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $discountPromotions], 200);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function delete(string $id)
    {
        try {
            $validateData = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:discount_promotions,id'
            ]);
            if ($validateData->fails()) {
                return response()->json($validateData->errors(), 403);
            }
            $this->model::findOrFail($id)->delete();
            return response()->json(['message' => 'Success operation', 'data' => 'OK'], 201);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function getAll(string $companyId)
    {
        try {
            $data = $this->model::where('company_id', $companyId)->get();
            return response()->json(['message' => 'Success operation', 'data' => $data], 201);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function getById(string $id)
    {
        try {
            $data = $this->model::findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $data], 201);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
