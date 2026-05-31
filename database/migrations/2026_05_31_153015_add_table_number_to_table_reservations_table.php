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
        Schema::table('table_reservations', function (Blueprint $table) {
            $table->string('table_number')->nullable()->after('guest_count');
            $table->string('area')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_reservations', function (Blueprint $table) {
            $table->dropColumn('table_number');
            $table->enum('area', ['Indoor', 'Outdoor', 'Smoking'])->default('Indoor')->change();
        });
    }
};
