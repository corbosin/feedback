<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            DB::table('users')->insert([
                'name' => 'manager',
                'password' => bcrypt('12345678'),
                'email' => 'manager@mail.ru',
                'role' => 0,
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('email', 'manager@mail.ru')->delete();
    }
};
