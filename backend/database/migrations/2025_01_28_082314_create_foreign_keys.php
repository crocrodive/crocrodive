<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public const TABLE_NAME = 'users'; // Table à modifier
    public const ROLE_TABLE = 'croc_roles'; // Table 'roles' à référencer
    public const LEVEL_TABLE = 'croc_levels'; // Table 'levels' à référencer
    public const TABLE_PREFIX = 'user_'; // Préfixe de la table des utilisateurs

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            // Ajouter une contrainte de clé étrangère pour 'role_id'
            $table->foreign('role_id')->references('role_id')->on(self::ROLE_TABLE)
                ->onDelete('cascade')  // Optionnel: définir le comportement lors de la suppression
                ->onUpdate('cascade'); // Optionnel: définir le comportement lors de la mise à jour

            // Ajouter une contrainte de clé étrangère pour 'leve_id'
            $table->foreign('leve_id')->references('leve_id')->on(self::LEVEL_TABLE)
                ->onDelete('cascade')  // Optionnel: définir le comportement lors de la suppression
                ->onUpdate('cascade'); // Optionnel: définir le comportement lors de la mise à jour
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            // Supprimer les clés étrangères
            $table->dropForeign(['role_id']);
            $table->dropForeign(['leve_id']);
        });
    }
};
