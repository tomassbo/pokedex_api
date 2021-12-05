<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Type;
use Exception;

class TypeController extends Controller
{

    public function index()
    {
        return Type::all();
    }

    public function store(Request $request)
    {

        $rules = array(
            'name' => 'required|max:100',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response([
                'res' => false,
                'message' => $validator->errors(),
            ], 401);

        try {

            $type = new Type();
            $type->name = $request->name;
            $type->save();
            return response([
                'res' => true,
                'message' =>  "Ok",
                'type' => $type
            ], 201);
        } catch (Exception $e) {

            return response([
                'res' => false,
                'message' =>  "Unexpected error.",
            ], 401);
        }
    }

    public function show(Request $request)
    {
        try {

            $type = Type::find($request->id);
            return response([
                'res' => true,
                'type' =>  $type,
            ], 200);
        } catch (Exception $e) {

            return response([
                'res' => false,
                'message' =>  "Unexpected error.",
            ], 401);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required|max:100',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response([
                'res' => false,
                'message' => $validator->errors(),
            ], 401);

        try {
            $type = Type::findOrFail($request->id);
            $type->name = $request->name;
            $type->save();

            return response([
                'res' => true,
                'type' =>  $type,
            ], 200);
        } catch (Exception $e) {

            return response([
                'res' => false,
                'message' =>  "Unexpected error.",
            ], 401);
        }
    }

    public function destroy(Request $request)
    {
        if (!isset($request->id))
            return response([
                'res' => false,
                'message' => "Required id",
            ], 401);

        $type = Type::destroy($request->id);
        return response([
            'res' => true,
            'id' =>  $request->id,
        ], 200);
    }
}
