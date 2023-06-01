<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\Products;
use App\Models\ShoppingList;
use App\Models\ShoppingListsProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $model;
    protected $modelCategory;
    protected $modelBrand;

    public function __construct()
    {
        //$this->middleware('auth:api');
        $this->model = new Products();
        $this->modelCategory = new Categories();
        $this->modelBrand = new Brands();
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'unit_cost' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'creator_id' => 'required|integer',
                'type' => 'required|string',
                'category.id' => 'nullable|integer|exists:categories,id',
                'category.name' => 'required|string|max:255',
                'category.description' => 'nullable|string',
                'brand.id' => 'nullable|integer|exists:brands,id',
                'brand.name' => 'required|string|max:255',
                'brand.state' => 'required|boolean',
                'brand.description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            } else {
                if ($request->all()['category']['id'] == null || $request->all()['category']['id'] == "0") {
                    $category = $this->modelCategory->create($request->all()['category']);
                }

                if ($request->all()['brand']['id'] == null || $request->all()['brand']['id'] == "0") {
                    $brands = $this->modelBrand->create($request->all()['brand']);
                }
                $newProduct = $this->model->create([
                    'type' => $request->all()['type'],
                    'creator_id' => $request->all()['creator_id'],
                    'name' => $request->all()['name'],
                    'unit_cost' => $request->all()['unit_cost'],
                    'description' => $request->all()['description'],
                    'brand_id' => isset($request->all()['brand']['id']) ? $request->all()['brand']['id'] : $brands->id,
                    'category_id' => isset($request->all()['category']['id']) ? $request->all()['category']['id'] : $category->id
                ]);

                return response()->json(['message' => 'Success operation', 'data' => $newProduct], 201);
            }
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
    public function storeProductShoppingList(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|string|exists:products,id',
                'user_id' => 'required|exists:users,id',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            } else {
                $product = Products::findOrFail($request->all()['id']);
                //Si tenemos una lista de compras activa traigala
                $shoppingList = ShoppingList::where('user_id', $request->all()['user_id'])->where('is_active', true)->first();
                //Existe
                if (isset($shoppingList)) {
                    $shoppingListsProducts = ShoppingListsProducts::where('shopping_list_id', $shoppingList->id)->where('product_id', $product->id)->first();
                    if (!isset($shoppingListsProducts)) {
                        ShoppingList::findOrFail($shoppingList->id)->update([
                            'estimated_price' => $shoppingList->estimated_price + $request->all()['unit_cost']
                        ]);
                        ShoppingListsProducts::create([
                            'quantity' => 1,
                            'shopping_list_id' => $shoppingList->id,
                            'product_id' => $product->id,
                            'total_cost' => $request->all()['unit_cost']
                        ]);
                    }
                    return response()->json(['message' => 'Success operation', 'data' => $shoppingList], 201);
                }else {
                    $shoppingList = ShoppingList::create([
                        'start_date' => Carbon::now(),
                        'estimated_price' => $product->unit_cost,
                        'user_id' => $request->all()['user_id'],
                    ]);
                    ShoppingListsProducts::create([
                        'quantity' => 1,
                        'shopping_list_id' => $shoppingList->id,
                        'product_id' => $product->id,
                        'total_cost' => $request->all()['unit_cost']
                    ]);
                    return response()->json(['message' => 'Success operation', 'data' => $shoppingList], 201);
                }
            }

        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
    public function storeProductByApi(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'unit_cost' => 'required|numeric|min:0',
                'creator_id' => 'required|integer',
                'type' => 'required|string',
                'category_identifier' => 'required|string',
                'category_name' => 'nullable',
                'id_api' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            } else {
                $category = Categories::where('identifier', $request->all()['category_identifier'])->first();
                if (!isset($category)) {
                    $category = Categories::create([
                        'name'=> $request->all()['category_name'],
                        'identifier' => $request->all()['identifier']
                    ]);
                }
                $product = Products::where('creator_id', $request->all()['creator_id'])->where('type', $request->all()['type'])->where('id_api', $request->all()['id_api'])->first();
                if (!isset($product)) {
                    $product = $this->model->create([
                        'name' => $request->all()['name'],
                        'unit_cost' => $request->all()['unit_cost'],
                        'description' => $request->all()['description'] ?? null,
                        'category_id' => $category->id,
                        'type' => $request->all()['type'],
                        'creator_id' => $request->all()['creator_id'],
                        'id_api'=> $request->all()['id_api'],
                    ]);
                }
                $shoppingList = ShoppingList::where('user_id', $request->all()['creator_id'])->where('is_active', true)->first();
                //Existe lista de deseos
                if (isset($shoppingList)) {
                    $shoppingListsProducts = ShoppingListsProducts::where('shopping_list_id', $shoppingList->id)->where('product_id', intval($product->id))->first();
                    // En caso de que este poducto no este en la lista crearlo
                    if (!isset($shoppingListsProducts)) {
                        // Actualizamos la lista de deseos
                        ShoppingList::findOrFail($shoppingList->id)->update([
                            'estimated_price' => $shoppingList->estimated_price + $request->all()['unit_cost']
                        ]);
                        ShoppingListsProducts::create([
                            'quantity' => 1,
                            'shopping_list_id' => $shoppingList->id,
                            'product_id' => intval($product->id),
                            'total_cost' => $request->all()['unit_cost']
                        ]);
                    }
                }else {
                    $shoppingList = ShoppingList::create([
                        'start_date' => Carbon::now(),
                        'estimated_price' => $request->all()['unit_cost'],
                        'user_id' => $request->all()['creator_id'],
                    ]);
                    ShoppingListsProducts::create([
                        'quantity' => 1,
                        'shopping_list_id' => $shoppingList->id,
                        'product_id' => $product->id,
                        'total_cost' => $request->all()['unit_cost']
                    ]);
                }
                return response()->json(['message' => 'Success operation', 'data' => $product], 201);
            }
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function findById(string $id)
    {
        try {
            $product =  $this->model::with('Category', 'Brand')->findOrFail($id);

            return response()->json(
                [
                    'message' => 'Success operation',
                    'data' => $product
                ],
            201);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function getList(string $id, string $type)
    {
        try {
            $products = $this->model::where('creator_id', $id)->where('type', $type)->get();
            return response()->json(
                [
                    'message' => 'Success operation',
                    'data' => $products
                ],
            201);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function update(string $id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'unit_cost' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'creator_id' => 'required|integer',
                'type' => 'required|string',
                'category.id' => 'nullable|integer|exists:categories,id',
                'category.name' => 'required|string|max:255',
                'category.description' => 'nullable|string',
                'brand.id' => 'nullable|integer|exists:brands,id',
                'brand.name' => 'required|string|max:255',
                'brand.state' => 'required|boolean',
                'brand.description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            } else {
                if ($request->all()['category']['id'] == null) {
                    $category = $this->modelCategory->create($request->all()['category']);
                }

                if ($request->all()['brand']['id'] == null) {
                    $brands = $this->modelBrand->create($request->all()['brand']);
                }
                $this->model::findOrFail($id)->update([
                    'name' => $request->all()['name'],
                    'unit_cost' => $request->all()['unit_cost'],
                    'description' => $request->all()['description'],
                    'brand_id' => isset($request->all()['brand']['id']) ? $request->all()['brand']['id'] : $brands->id,
                    'category_id' => isset($request->all()['category']['id']) ? $request->all()['category']['id'] : $category->id
                ]);
                $updateProducts = $this->model::findOrFail($id);
                return response()->json(['message' => 'Success operation', 'data' => $updateProducts], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function delete(int $id)
    {
        try {
            $validateData = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:products,id'
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

    public function getProductsByCompanies(string $id, string $type)
    {
        try {
            $productCompanies = Products::with('Category')->where('type', $type)->get()->toArray();
            $data = collect($productCompanies)->map(function ($item, $key) {
                $company = Companies::findOrFail($item['creator_id']);
                $item['address'] = $company['address_description'];
                return $item;
            });
            if ($type === 'COMPANY') {
                return response()->json(['message' => 'Success operation', 'data' => $data], 201);
            }
            if ($type === 'USERS') {
                $productByUser = Products::where('type', $type)->where('creator_id', $id)->get()->toArray();
                return response()->json(['message' => 'Success operation', 'data' => array_merge($data, $productByUser)], 201);
            }

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
