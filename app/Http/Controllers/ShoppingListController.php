<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ShoppingList;
use App\Models\ShoppingListsProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShoppingListController extends Controller
{
    protected $model;

    public function __construct()
    {
        //$this->middleware('auth:api');
        $this->model = new ShoppingList();
    }

    public function getByUser(string $userId)
    {
        try {
            $data =  $this->model::with('shoppingListProducts')->where('user_id', $userId)->where('is_active', true)->first();
            collect($data->shoppingListProducts)->map(function ($product) {
                $product['product'] = Products::findOrFail($product->product_id);
                return $product;
            });
            return response()->json(['message' => 'Success operation', 'data' => $data], 200);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function getListReport(string $userId)
    {
        try {
            $data =  $this->model::with('shoppingListProducts')->where('user_id', $userId)->where('is_active', false)->get();
            $collection = collect($data)->map(function ($item) {
                collect($item->shoppingListProducts)->map(function ($product) {
                    $product['product'] = Products::findOrFail($product->product_id);
                    return $product;
                });
                return $item;
            });
            return response()->json(['message' => 'Success operation', 'data' => $collection], 200);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function updateList(string $id, string $isUpdateProduct, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name_list' => 'required|string|max:255',
                'estimated_price' => 'required',
                'shopping_list_products.*.id' => 'required|exists:shopping_lists_products,id',
                'shopping_list_products.*.quantity' => 'required',
                'shopping_list_products.*.total_cost' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            } else {
                $data = $this->model::findOrFail($id)->update([
                    'name_list' => $request->all()['name_list'],
                    'estimated_price' => $request->all()['estimated_price'],
                    'is_active' => $isUpdateProduct == '1' ? true :false
                ]);

                foreach ($request['shopping_list_products'] as $value) {
                    ShoppingListsProducts::findOrFail($value['id'])->update([
                        'quantity' => $value['quantity'],
                        'total_cost' => $value['total_cost']
                    ]);
                }
                return response()->json(['message' => 'Success operation', 'data' => $data], 200);
            }
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
