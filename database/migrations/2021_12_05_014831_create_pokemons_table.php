<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('hp');
            $table->boolean('first_edition');
            $table->unsignedBigInteger('expansion_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('rarity_id');
            $table->decimal('price');
            $table->string('image');
            $table->timestamps();

            $table->foreign('expansion_id')->references('id')->on('expansions');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('rarity_id')->references('id')->on('rarities');
        });



        $now = Carbon\Carbon::now();
        DB::table('pokemons')->insert([
            [
                'name' => 'Base Set',
                'hp' => 10,
                'first_edition' => 1,
                'expansion_id' => 1,
                'type_id' => 6,
                'rarity_id' => 1,
                'price' => 1500,
                'image' => 'https://cdn.shopify.com/s/files/1/0411/2623/2231/products/Charizard4-102_480x.jpg?v=1593225355',
                'created_at' => $now->toDateTimeString()
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemons');
    }
}
