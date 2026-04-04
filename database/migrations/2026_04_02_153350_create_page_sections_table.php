<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('page_id')
                ->constrained('pages')
                ->cascadeOnDelete();

            $table->string('section_key', 100);
            $table->string('section_name', 150);

            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('content')->nullable();

            $table->string('image_1')->nullable();
            $table->string('image_1_link')->nullable();

            $table->string('image_2')->nullable();
            $table->string('image_2_link')->nullable();

            $table->string('button_text', 100)->nullable();
            $table->string('button_link')->nullable();

            $table->string('extra_1')->nullable();
            $table->string('extra_2')->nullable();
            $table->string('extra_3')->nullable();

            $table->integer('sort_order')->default(1);
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique(['page_id', 'section_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
