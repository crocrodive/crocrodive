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
        Schema::table('croc_diving_groups', function (Blueprint $table) {
            // Suppression des anciennes contraintes de clé étrangère
            $table->dropForeign(['sess_id']);
            $table->dropForeign(['instructor_user_id']);

            // Ajout de nouvelles contraintes avec suppression en cascade
            $table->foreign('sess_id')
                ->references('sess_id')
                ->on('croc_sessions')
                ->onDelete('cascade'); // Supprime les groupes de plongée si la session est supprimée

            $table->foreign('instructor_user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade'); // Supprime les groupes si l'instructeur est supprimé
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('croc_diving_groups', function (Blueprint $table) {
            // Suppression des nouvelles contraintes
            $table->dropForeign(['sess_id']);
            $table->dropForeign(['instructor_user_id']);

            // Réajout des anciennes contraintes sans cascade
            $table->foreign('sess_id')
                ->references('sess_id')
                ->on('croc_sessions');

            $table->foreign('instructor_user_id')
                ->references('user_id')
                ->on('users');
        });
    }
};
