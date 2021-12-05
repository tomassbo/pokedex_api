<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Expansion;
use Exception;

class ExpansionController extends Controller
{
    public function index()
    {
        return Expansion::all();
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

            $expansion = new Expansion();
            $expansion->name = $request->name;
            $expansion->save();
            return response([
                'res' => true,
                'message' =>  "Ok",
                'type' => $expansion
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

            $expansion = Expansion::find($request->id);
            return response([
                'res' => true,
                'type' =>  $expansion,
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
            'name' => 'required|max:10',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response([
                'res' => false,
                'message' => $validator->errors(),
            ], 401);

        try {
            $expansion = Expansion::findOrFail($request->id);
            $expansion->name = $request->name;
            $expansion->save();

            return response([
                'res' => true,
                'type' =>  $expansion,
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

        $expansion = Expansion::destroy($request->id);
        return response([
            'res' => true,
            'id' =>  $request->id,
        ], 200);
    }
}
