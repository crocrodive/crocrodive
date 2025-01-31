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
        Schema::table('croc_sessions', function (Blueprint $table) {
            // Suppression de l'ancienne contrainte de clé étrangère sur cour_id
            $table->dropForeign(['cour_id']);

            // Ajout de la nouvelle contrainte avec suppression en cascade
            $table->foreign('cour_id')
                ->references('cour_id')
                ->on('croc_courses')
                ->onDelete('cascade'); // Supprime les sessions si le cours est supprimé
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('croc_sessions', function (Blueprint $table) {
            // Suppression de la contrainte avec cascade
            $table->dropForeign(['cour_id']);

            // Réajout de l'ancienne contrainte sans cascade
            $table->foreign('cour_id')
                ->references('cour_id')
                ->on('croc_courses');
        });
    }
};
