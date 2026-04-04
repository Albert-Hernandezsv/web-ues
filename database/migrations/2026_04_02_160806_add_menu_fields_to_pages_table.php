<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('show_in_menu')->default(true)->after('status');
            $table->integer('menu_order')->default(1)->after('show_in_menu');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['show_in_menu', 'menu_order']);
        });
    }
};
