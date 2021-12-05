<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->decimal('price', 6);
            $table->string('image');
            $table->timestamps();

            $table->foreign('expansion_id')->references('id')->on('expansions');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('rarity_id')->references('id')->on('rarities');
        });
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
