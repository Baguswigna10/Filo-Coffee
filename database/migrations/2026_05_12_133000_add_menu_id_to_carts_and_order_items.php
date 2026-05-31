<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->change();
            if (!Schema::hasColumn('carts', 'menu_id')) {
                $table->foreignId('menu_id')->nullable()->after('product_id')->constrained()->onDelete('cascade');
            }
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->change();
            if (!Schema::hasColumn('order_items', 'menu_id')) {
                $table->foreignId('menu_id')->nullable()->after('product_id')->constrained()->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropColumn('menu_id');
            $table->foreignId('product_id')->nullable(false)->change();
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropColumn('menu_id');
            $table->foreignId('product_id')->nullable(false)->change();
        });
    }
};
