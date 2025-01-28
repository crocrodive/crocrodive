<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public const TABLE_NAME = 'croc_evaluations';
    public const TABLE_PREFIX = 'eval_';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->uuid(self::TABLE_PREFIX . 'id')->primary();
            $table->foreignUuid('user_id')
                ->constrained('users', 'user_id')
            ;
            $table->foreignUuid('abil_id')
                ->constrained('croc_abilities', 'abil_id')
            ;
            $table->foreignUuid('sess_id')
                ->constrained('croc_sessions', 'sess_id')
            ;
            $table->foreignId('rati_id')
                ->constrained('croc_ratings', 'rati_id')
            ;
            $table->text(self::TABLE_PREFIX . 'comment');
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
