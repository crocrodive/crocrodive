<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public const TABLE_NAME = 'users'; // Table à modifier
    public const TABLE_PREFIX = 'user_'; // Préfixe de la table des utilisateurs

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table(table: self::TABLE_NAME, callback: function (Blueprint $table): void {
            $table->string(column: self::TABLE_PREFIX.'telephone', length: 64)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table(table: self::TABLE_NAME, callback: function (Blueprint $table): void {
            $table->string(column: self::TABLE_PREFIX.'telephone', length: 255)->change();
        });
    }
};
