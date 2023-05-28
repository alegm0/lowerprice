<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;
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

    public function storeProductByApi(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'unit_cost' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'creator_id' => 'required|integer',
                'category_identifier' => 'required|string|exists:categories,identifier',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            } else {
                $category = Categories::where('identifier', $request->all()['category_identifier'])->first();
                $newProduct = $this->model->create([
                    'name' => $request->all()['name'],
                    'unit_cost' => $request->all()['unit_cost'],
                    'description' => $request->all()['description'],
                    'category_id' => $category->id
                ]);

                return response()->json(['message' => 'Success operation', 'data' => $newProduct], 201);
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

    public function getList(string $id)
    {
        try {
            $products = $this->model::where('creator_id', $id)->get();
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
}
