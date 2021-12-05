<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pokemon;
use Exception;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        try {

            $filters = [];

            if (isset($request->type_id))
                $filters[] = ['type_id', '=', $request->type_id];

            if (isset($request->rarity_id))
                $filters[] = ['rarity_id', '=', $request->rarity_id];

            if (isset($request->expansion_id))
                $filters[] = ['expansion_id', '=', $request->expansion_id];

            $pokemons = Pokemon::select()->where($filters)->get();

            return response([
                'res' => true,
                'pokemons' =>  $pokemons,
            ], count($pokemons) == 0 ? 204 : 200);
        } catch (Exception $e) {
            return response([
                'res' => false,
                'message' =>  "Unexpected error.",
            ], 401);
        }
    }



    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|max:100',
            'hp' => 'required|integer',
            'first_edition' => 'required|boolean',
            'expansion_id' => 'required|integer',
            'type_id' => 'required|integer',
            'rarity_id' => 'required|integer',
            'price' => 'required',
            'image' => 'required|url',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response([
                'res' => false,
                'message' => $validator->errors(),
            ], 401);


        if (!PokemonController::isMultipleOfTen($request->hp))
            return response([
                'res' => false,
                'message' => "The hp must be multiples of 10",
            ], 401);

        try {
            $pokemon = new Pokemon();
            $pokemon->name = $request->name;
            $pokemon->hp = $request->hp;
            $pokemon->first_edition = $request->first_edition;
            $pokemon->expansion_id = $request->expansion_id;
            $pokemon->type_id = $request->type_id;
            $pokemon->rarity_id = $request->rarity_id;
            $pokemon->price = $request->price;
            $pokemon->image = $request->image;

            $pokemon->save();
            return response([
                'res' => true,
                'message' =>  "Ok",
                'pokemon' => $pokemon
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
            $expansion = Pokemon::find($request->id);
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
            'name' => 'required|max:100',
            'hp' => 'required|integer',
            'first_edition' => 'required|boolean',
            'expansion_id' => 'required|integer',
            'type_id' => 'required|integer',
            'rarity_id' => 'required|integer',
            'price' => 'required',
            'image' => 'required|url',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response([
                'res' => false,
                'message' => $validator->errors(),
            ], 401);

        if (!PokemonController::isMultipleOfTen($request->hp))
            return response([
                'res' => false,
                'message' => "The hp must be multiples of 10",
            ], 401);

        try {
            $pokemon = Pokemon::findOrFail($request->id);
            $pokemon->name = $request->name;
            $pokemon->hp = $request->hp;
            $pokemon->first_edition = $request->first_edition;
            $pokemon->expansion_id = $request->expansion_id;
            $pokemon->type_id = $request->type_id;
            $pokemon->rarity_id = $request->rarity_id;
            $pokemon->price = $request->price;
            $pokemon->image = $request->image;
            $pokemon->save();

            return response([
                'res' => true,
                'pokemon' =>  $pokemon,
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

        $expansion = Pokemon::destroy($request->id);
        return response([
            'res' => true,
            'id' =>  $request->id,
        ], 200);
    }


    private static function isMultipleOfTen($num)
    {
        return ((int)$num % 10) == 0 ? true : false;
    }
}
