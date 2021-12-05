<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rarity;
use Exception;


class RarityController extends Controller
{
    public function index()
    {
        return Rarity::all();
    }

    public function store(Request $request)
    {
        if (!isset($request->name))
            return response([
                'res' => false,
                'message' => "Required Name",
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
        if (!isset($request->id))
            return response([
                'res' => false,
                'message' => "Required id",
            ], 401);

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
        if (!isset($request->id) || !isset($request->name))
            return response([
                'res' => false,
                'message' => "Id and name are required",
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
