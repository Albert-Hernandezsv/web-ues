<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_section_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('page_section_id')
                ->constrained('page_sections')
                ->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('content')->nullable();

            $table->string('image')->nullable();
            $table->string('link')->nullable();

            $table->string('extra_1')->nullable();
            $table->string('extra_2')->nullable();
            $table->string('extra_3')->nullable();

            $table->integer('sort_order')->default(1);
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section_items');
    }
};
