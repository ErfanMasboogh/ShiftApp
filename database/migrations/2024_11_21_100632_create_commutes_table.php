<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commutes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->time('enter');
            $table->time('exit')->nullable();
            $table->unsignedInteger('salary')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->date('enter_date');
            $table->date('exit_date');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commutes');
    }
};
