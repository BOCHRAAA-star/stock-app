<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('site_id')->nullable()->after('category_id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('products', 'site_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropForeign(['site_id']);
                $table->dropColumn('site_id');
            });
        }
    }
};
