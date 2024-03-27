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
        Schema::table('place_groups', function (Blueprint $table) {
            $table->foreignId('livret_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('place_groups', function (Blueprint $table) {
            $table->dropForeign(['livret_id']);
            $table->dropColumn('livret_id');
        });
    }
};
