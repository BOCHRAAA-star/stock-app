<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_movements', function (Blueprint $table) {
            $table->foreignId('site_id')->nullable()->after('user_name')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('stock_movements', 'site_id')) {
            Schema::table('stock_movements', function (Blueprint $table) {
                $table->dropForeign(['site_id']);
                $table->dropColumn('site_id');
            });
        }
    }
};
