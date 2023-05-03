<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\AddressClient;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Address();
        //$this->middleware('auth:api');
    }

    public function store(Request $request)
    {
       try {
            $user = User::find($request->user_id);
            $validateData = Validator::make($request->all(), [
                'user_id' => 'required|integer|exists:users,id',
                'city_id' => 'required|integer|exists:cities,id',
                'department_id' => 'required|integer|exists:departments,id',
                'country_id' => 'required|integer|exists:countries,id',
                'name' => 'required|string',
                'postal_code' => 'nullable|string|max:8',
            ]);
            if($validateData->fails()){
                return response()->json($validateData->errors(), 403);
            }
            $address = $this->model::create($request->all());
            return response()->json(['message' => 'Success operation', 'data' => $address], 201);
       } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
       }
    }

    public function update(Request $request, string $id)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'user_id' => 'required|integer|exists:users,id',
                'city_id' => 'required|integer|exists:cities,id',
                'department_id' => 'required|integer|exists:departments,id',
                'country_id' => 'required|integer|exists:countries,id',
                'name' => 'required|string',
                'postal_code' => 'nullable|string|max:8',
            ]);
            if ($validateData->fails()) {
                return response()->json($validateData->errors(), 403);
            }
            $this->model::findOrFail($id)->update($request->all());
            $address = $this->model::findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $address], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function delete(string $id)
    {
        try {
            $validateData = Validator::make(['id' => $id], [
                'id' => 'required|exists:addresses,id'
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
