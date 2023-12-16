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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('caption', 2200)->nullable();
            $table->json('tags')->nullable();
            $table->string('image_url')->nullable(false);
            $table->string('image_id', 2200)->nullable(false);
            $table->string('location', 2200);
            $table->foreignId('creator')->nullable()->constrained(
                'users', 'id'
            )->nullOnDelete();            
            $table->index(['caption'], 'caption_index')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
