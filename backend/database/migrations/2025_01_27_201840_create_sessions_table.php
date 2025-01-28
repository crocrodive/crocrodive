<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public const TABLE_NAME = 'croc_sessions';
    public const TABLE_PREFIX = 'sess_';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->uuid(self::TABLE_PREFIX . 'id')->primary();
            $table->foreignUuid('cour_id')
                ->constrained('croc_courses', 'cour_id')
            ;
            $table->datetime(self::TABLE_PREFIX . 'date');
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
