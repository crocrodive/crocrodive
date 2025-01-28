<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public const TABLE_NAME = 'croc_abilities';
    public const TABLE_PREFIX = 'abil_';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->uuid(self::TABLE_PREFIX . 'id')->primary();
            $table->foreignUuid('skil_id')
                ->constrained('croc_skills', 'skil_id')
            ;
            $table->string(self::TABLE_PREFIX . 'label', 128);
            $table->timestamps();
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
