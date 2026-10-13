<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Only the sole legacy account can be safely designated automatically.
        if (DB::table('users')->count() > 1) throw new RuntimeException('Defina el administrador inicial antes de migrar: existen varias cuentas.');
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('editor');
            $table->boolean('is_active')->default(true);
            $table->json('permissions')->nullable();
        });
        DB::table('users')->update(['role'=>'admin']);
    }
    public function down(): void
    {
        Schema::table('users', fn (Blueprint $table) => $table->dropColumn(['role','is_active','permissions']));
    }
};
