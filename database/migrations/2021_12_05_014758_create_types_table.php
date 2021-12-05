<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $now = Carbon\Carbon::now();
        DB::table('types')->insert([
            ['name' => 'Bicho', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Dragón', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Eléctrico', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Hada', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Lucha', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Fuego', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Volador', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Fantasma', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Planta', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Tierra', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Hielo', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Normal', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Veneno', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Psíquico', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Roca', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Acero', 'created_at' => $now->toDateTimeString()],
            ['name' => 'Agua', 'created_at' => $now->toDateTimeString()]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
