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
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->reference('id')->on('users');
            $table->string('code_one');
            $table->string('code_two');
            $table->string('code_one_comparison');
            $table->string('code_two_comparison');
            $table->boolean('stages')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('codes');
    }
};
