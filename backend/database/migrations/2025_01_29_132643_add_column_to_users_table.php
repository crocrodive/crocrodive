<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'users';
    private const TABLE_PREFIX = 'user_';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            // code insee de la ville d'habitation 
            $table->char('town_insee', 5);
            $table->foreign('town_insee')->references('town_insee')->on('croc_towns');

            // adresse
            $table->string(self::TABLE_PREFIX.'address', 255);

            // date de naissance
            $table->date(self::TABLE_PREFIX.'birth_date');

            // numéro license de plongée
            $table->string(self::TABLE_PREFIX.'diving_license_number', 32);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['town_insee']);
            $table->dropColumn('town_insee');
            $table->dropColumn(self::TABLE_PREFIX.'address');
            $table->dropColumn(self::TABLE_PREFIX.'birth_date');
            $table->dropColumn(self::TABLE_PREFIX.'diving_license_number');
        });
    }
};
