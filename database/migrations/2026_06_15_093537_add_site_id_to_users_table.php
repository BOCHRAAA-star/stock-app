<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('site_id')->nullable()->after('role')->constrained()->nullOnDelete();
        });
    }

  public function down(): void
{
    if (Schema::hasColumn('users', 'site_id')) {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['site_id']);
            $table->dropColumn('site_id');
        });
    }
}
};
