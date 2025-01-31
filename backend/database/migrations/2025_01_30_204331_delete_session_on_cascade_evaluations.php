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
        Schema::table('croc_evaluations', function (Blueprint $table) {
            // Suppression de l'ancienne contrainte
            $table->dropForeign(['sess_id']);

            // Ajout de la nouvelle contrainte avec suppression en cascade
            $table->foreign('sess_id')
                ->references('sess_id')
                ->on('croc_sessions')
                ->onDelete('cascade'); // Supprime les évaluations si la session est supprimée
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('croc_evaluations', function (Blueprint $table) {
            // Suppression de la contrainte avec cascade
            $table->dropForeign(['sess_id']);

            // Réajout de la contrainte d'origine sans cascade
            $table->foreign('sess_id')
                ->references('sess_id')
                ->on('croc_sessions');
        });
    }
};
