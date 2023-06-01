<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Companies();
    }

    public function findByEmail(string $email)
    {
        return $this->model::where('email', $email)->first();
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|integer',
            'email' => 'required|string|email',
            'website' => 'nullable|string',
            'size_company' => 'nullable|string',
            'is_active' => 'required|boolean',
            'address_description' => 'nullable|string',
            'city_id' => 'nullable|integer|exists:cities,id',
            'country_id' => 'nullable|integer|exists:countries,id',
            'department_id' => 'nullable|integer|exists:departments,id'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        else
        {
            $this->model::findOrFail($id)->update($request->all());
            $updateProducts = $this->model::findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $updateProducts], 201);
        }
    }


    public function find(string $id)
    {
        try {
            if (!isset($id)) {
                return response()->json('Send the parameter', 403);
            }
            $data = $this->model::with('paymentMethods')->findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function storePaymentMethod(Request $request)
    {
        $companies = Companies::find($request[0]['company_id']);
        $companies->paymentMethods()->detach();
        $validator = Validator::make($request->all(), [
            '*.payment_method_id' => 'required|integer',
            '*.company_id' => 'required|integer',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        else
        {
            $companies->paymentMethods()->attach($request->all());
            $data = $this->model::with('paymentMethods')->findOrFail($request[0]['company_id']);
            return response()->json(['message' => 'Success operation', 'data' => $data], 201);
        }
    }

    public function deletePaymentMethod(string $id)
    {
        $company = Companies::findOrFail(1);
        $paymentMethod = PaymentMethod::findOrFail($id);

        $company->paymentMethods()->detach($paymentMethod->id);
        return response()->json(['message' => 'Success operation', 'data' => 'Ok'], 201);
    }

    public function getAll()
    {
        return  $this->model::all();
    }

    public function getAllCompanyByAddress()
    {
        return response()->json(['message' => 'Success operation', 'data' => $this->model::get()], 201);
    }
}
