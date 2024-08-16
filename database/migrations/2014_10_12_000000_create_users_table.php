<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role_code')->default('USER');
            $table->enum('active_flag',['Y','N'])->default('Y');
            $table->rememberToken();
            $table->timestamps();
        });

        // Create a user after the table is created
        DB::table('users')->insert([
            'name' => 'eyJpdiI6ImkwOTAyT1RQMmlwcjBqK0JwUFBacFE9PSIsInZhbHVlIjoiTXpHcHkyNFNwTHhqU1kxMzVOcEhDQT09IiwibWFjIjoiNTE2M2RiMmRlOTM0NWUwNThlZmQ3YmU4OWNiZGM2NTVjOGUwMTNiNDc2MTZkZGE4ZTg1YTRjY2YyZjhiZDM0MiIsInRhZyI6IiJ9',
            'email' => 'admin@example.com',
            'password' => Hash::make('Default@123'), // Replace 'password' with a strong password
            'role_code' => 'ADMIN',
            'active_flag' => 'Y',
            'email_verified_at'=> now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
