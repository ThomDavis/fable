<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fables', function (Blueprint $table) {
            $table->id();
            $table->morphs('fable');
            $table->string('action');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->jsonb('old_value')->nullable();
            $table->json('new_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fables');
    }
};
