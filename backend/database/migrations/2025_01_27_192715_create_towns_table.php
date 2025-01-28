<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public const TABLE_NAME = 'croc_towns';
    public const TABLE_PREFIX = 'town_';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->char(self::TABLE_PREFIX . 'insee', 5)->primary();
            $table->string(self::TABLE_PREFIX . 'postal_code', 5);
            $table->string(self::TABLE_PREFIX . 'name', 128);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
