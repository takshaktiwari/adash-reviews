<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->default(null);
            $table->string('name');
            $table->string('mobile')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->integer('rating');
            $table->string('title', 255)->nullable()->default(null);
            $table->text('content');
            $table->nullableMorphs('reviewable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
