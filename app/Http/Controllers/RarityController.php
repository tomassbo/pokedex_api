<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rarity;
use Illuminate\Support\Facades\Validator;
use Exception;


class RarityController extends Controller
{
    public function index()
    {
        return Rarity::all();
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
            $rarity = new Rarity();
            $rarity->name = $request->name;
            $rarity->save();
            return response([
                'res' => true,
                'message' =>  "Ok",
                'type' => $rarity
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
            $rarity = Rarity::find($request->id);
            return response([
                'res' => true,
                'type' =>  $rarity,
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
            $rarity = Rarity::findOrFail($request->id);
            $rarity->name = $request->name;
            $rarity->save();

            return response([
                'res' => true,
                'type' =>  $rarity,
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

        $rarity = Rarity::destroy($request->id);
        return response([
            'res' => true,
            'id' =>  $request->id,
        ], 200);
    }
}
