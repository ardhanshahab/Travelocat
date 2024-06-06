<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('email');
            $table->text('komentar');
            $table->string('T1');
            $table->string('T2');
            $table->string('R1');
            $table->string('R2');
            $table->string('S1');
            $table->string('S2');
            $table->string('A1');
            $table->string('A2');
            $table->string('E1');
            $table->string('E2');
            $table->unsignedTinyInteger('rating'); // rating dari 1 sampai 5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
