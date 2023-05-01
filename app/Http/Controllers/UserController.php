<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function findByEmail(string $email)
    {
        return $this->model::where('email', $email)->first();
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string',
            'document_type_id' => 'required|uuid',
            'phone' => 'nullable|integer',
            'document_number' => 'required|integer',
            'gender_id' => 'nullable|integer'
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        } else {
            $this->model::findOrFail($id)->update($request->all());
            $updateUser = $this->model::findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $updateUser], 201);
        }
    }

    public function find(string $id)
    {
        try {
            if (!isset($id)) {
                return response()->json('Send the parameter', 403);
            }
            $data = $this->model::with('address.Country','address.Department','address.City', 'gender')->findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
