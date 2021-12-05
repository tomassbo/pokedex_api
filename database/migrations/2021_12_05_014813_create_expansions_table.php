<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateExpansionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expansions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $now = Carbon\Carbon::now();
        DB::table('expansions')->insert([
            ['name' => 'Base Set', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Jungle', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Fossil', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Base Set 2', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Team RocketGym Heroes', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Gym Challenge', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Neo Genesis', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Neo Discovery', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Neo Revelation', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Neo Destiny', 'created_at' => $now->toDateTimeString()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expansions');
    }
}
