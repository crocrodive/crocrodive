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
            // Suppression de l'ancienne contrainte de clé étrangère sur user_id
            $table->dropForeign(['user_id']);

            // Ajout de la nouvelle contrainte avec suppression en cascade
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade'); // Supprime les évaluations si l'utilisateur est supprimé
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('croc_evaluations', function (Blueprint $table) {
            // Suppression de la contrainte avec cascade
            $table->dropForeign(['user_id']);

            // Réajout de l'ancienne contrainte sans cascade
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
        });
    }
};