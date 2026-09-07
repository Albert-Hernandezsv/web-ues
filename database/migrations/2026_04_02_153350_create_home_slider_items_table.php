<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_slider_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('page_id')
                ->constrained('pages')
                ->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('image');
            $table->string('link')->nullable();

            $table->integer('sort_order')->default(1);
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_slider_items');
    }
};
