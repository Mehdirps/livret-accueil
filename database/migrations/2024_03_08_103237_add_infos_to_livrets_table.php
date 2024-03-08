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
        Schema::table('livrets', function (Blueprint $table) {
            $table->string('logo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tripadvisor')->nullable();
            $table->string('twitter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livrets', function (Blueprint $table) {
            $table->dropColumn('logo');
            $table->dropColumn('facebook');
            $table->dropColumn('linkedin');
            $table->dropColumn('instagram');
            $table->dropColumn('tripadvisor');
            $table->dropColumn('twitter');
        });
    }
};
