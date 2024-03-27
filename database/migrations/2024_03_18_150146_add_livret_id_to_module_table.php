<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('module_wifi', function (Blueprint $table) {
            $table->foreignId('livret');
        });
        Schema::table('module_utils_phone', function (Blueprint $table) {
            $table->foreignId('livret');
        });
        Schema::table('module_utils_infos', function (Blueprint $table) {
            $table->foreignId('livret');
        });
        Schema::table('module_start_infos', function (Blueprint $table) {
            $table->foreignId('livret');
        });
        Schema::table('module_home', function (Blueprint $table) {
            $table->foreignId('livret');
        });
        Schema::table('module_end_infos', function (Blueprint $table) {
            $table->foreignId('livret');
        });
        Schema::table('module_digicode', function (Blueprint $table) {
            $table->foreignId('livret');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module_wifi', function (Blueprint $table) {
            $table->dropForeign(['livret']);
            $table->dropColumn('livret');
        });
        Schema::table('module_utils_phone', function (Blueprint $table) {
            $table->dropForeign(['livret']);
            $table->dropColumn('livret');
        });
        Schema::table('module_utils_infos', function (Blueprint $table) {
            $table->dropForeign(['livret']);
            $table->dropColumn('livret');
        });
        Schema::table('module_start_infos', function (Blueprint $table) {
            $table->dropForeign(['livret']);
            $table->dropColumn('livret');
        });
        Schema::table('module_home', function (Blueprint $table) {
            $table->dropForeign(['livret']);
            $table->dropColumn('livret');
        });
        Schema::table('module_end_infos', function (Blueprint $table) {
            $table->dropForeign(['livret']);
            $table->dropColumn('livret');
        });
        Schema::table('module_digicode', function (Blueprint $table) {
            $table->dropForeign(['livret']);
            $table->dropColumn('livret');
        });
    }
};
