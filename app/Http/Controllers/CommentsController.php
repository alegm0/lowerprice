<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    protected $model;

    public function __construct()
    {
        //$this->middleware('auth:api');
        $this->model = new Comments();
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'name_user' => 'required',
                'assessment' => 'required|integer|min:1|max:5',
                'start_date' => 'required',
                'title' => 'required|string',
                'text' => 'required|string',
                'contact_information' => 'required|string',
                'product_id' => 'required|exists:products,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
            $comments = $this->model->create($request->all());
            return response()->json(['message' => 'Success operation', 'data' => $comments], 200);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'name_user' => 'required',
                'assessment' => 'required|integer|min:1|max:5',
                'start_date' => 'required',
                'title' => 'required|string',
                'text' => 'required|string',
                'contact_information' => 'required|string',
                'product_id' => 'required|exists:products,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
            $this->model->findOrFail($id)->update($request->all());
            $comments =  $this->model->findOrFail($id);
            return response()->json(['message' => 'Success operation', 'data' => $comments], 200);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function delete(string $id)
    {
        try {
            $validateData = Validator::make(['id' => $id], [
                'id' => 'required|integer|exists:comments,id'
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

    public function getAllByProduct(string $productId)
    {
        try {
            $validateData = Validator::make(['id' => $productId], [
                'id' => 'required|integer|exists:products,id'
            ]);
            if ($validateData->fails()) {
                return response()->json($validateData->errors(), 403);
            }
            $data = $this->model::where('product_id', $productId)->get();
            $prom = $this->model::where('product_id', $productId)->avg('assessment');
            return response()->json([
                'message' => 'Success operation',
                'data' => [
                    'comments' => $data,
                    'score' => intval($prom)
                ]], 201);
        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
