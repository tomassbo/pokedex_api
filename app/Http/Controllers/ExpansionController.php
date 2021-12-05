<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        if (!isset($request->name))
            return response([
                'res' => false,
                'message' => "Required Name",
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
        if (!isset($request->id))
            return response([
                'res' => false,
                'message' => "Required id",
            ], 401);

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
        if (!isset($request->id) || !isset($request->name))
            return response([
                'res' => false,
                'message' => "Id and name are required",
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
