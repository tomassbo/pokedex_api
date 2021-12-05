<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        $now = Carbon\Carbon::now();
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'tomas@qa.com',
                'password' => '$2y$10$l6ZiVEcA96owR6vwyvkafuBCsOP8GIkKPwjycscznfjQJDw/Iiogy',
                'email_verified_at' => $now->toDateTimeString(),
                'created_at' => $now->toDateTimeString()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
