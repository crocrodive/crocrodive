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
        Schema::table('croc_sites', function (Blueprint $table) {
            $table->dropForeign(['town_insee']);
            $table->char('town_insee', 5)->change();
            $table->foreign('town_insee')->references('town_insee')->on('croc_towns');
        });
    }

    
    public function down(): void
    {
        Schema::table('croc_sites', function (Blueprint $table) {
            $table->dropForeign(['town_insee']);
            $table->char('town_insee', 5)->change();
            $table->foreign('town_insee')->references('town_insee')->on('croc_towns');
        });
    }
    
};
