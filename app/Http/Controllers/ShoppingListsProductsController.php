<?php

namespace App\Http\Controllers;

use App\Models\ShoppingListsProducts;
use Illuminate\Support\Facades\Validator;

class ShoppingListsProductsController extends Controller
{
    protected $model;

    public function __construct()
    {
        //$this->middleware('auth:api');
        $this->model = new ShoppingListsProducts();
    }

    public function deleteProducts(string $id)
    {
        try {
            $validateData = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:shopping_lists_products,id'
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
}
