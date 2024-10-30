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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

//Laravel හි migrate command එක මගින් ඔබට database schema එක තනා ගැනීම හෝ වෙනස් කිරීම සඳහා migration ගොනු ක්‍රියාත්මක කළ හැකිය.
//Migrations ක්‍රියාත්මක කිරීමේ පියවර
//Migration ක්‍රියාත්මක කිරීමට, පහත command එක භාවිතා කරන්න:
                //php artisan migrate
                //=====================//
                //මෙම command එක ක්‍රියාත්මක කිරීමෙන්, Laravel මගින් database/migrations ෆෝල්ඩරයේ සියලුම migration ගොනු කියවයි.

                //සෑම migration ගොනුවක් සඳහාම Laravel මගින් up විධිය ක්‍රියාත්මක කරයි. මෙහිදී, නව ටේබල්ස් තැනීම, columns එකතු කිරීම වැනි වෙනස්කම් සිදු කරයි.
                //ක්‍රියාත්මක කරන ලද migration එක migrations ටේබල් එක තුළ "සම්පූර්ණ වූ" ලෙස ලකුණු කරයි.


        //තවත් Migration Commands

                //Rollback: ආසන්නතම migration එක අවලංගු කිරීමට:
                //php artisan migrate:rollback

                //Reset: සියලුම migrations අවලංගු කිරීමට:
                //php artisan migrate:reset

                //Refresh: සියලුම migrations reset කර නැවත ක්‍රියාත්මක කිරීමට:
                //php artisan migrate:refresh

                //Fresh: සියලු tables drop කර නැවත සියලුම migrations ක්‍රියාත්මක කිරීමට:
                //php artisan migrate:fresh
