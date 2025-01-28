<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'croc_levels';
    private const TABLE_PREFIX = 'leve_';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->foreignId('instructor_required_level_id')
                ->constrained('croc_levels', 'leve_id')
                ->nullable()
            ;
            $table->unsignedBigInteger('instructor_required_level_id')->nullable()->change();

            $table->boolean(self::TABLE_PREFIX . 'has_courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->dropForeign(['instructor_required_level_id']);
            $table->dropColumn('instructor_required_level_id');
            $table->dropColumn(self::TABLE_PREFIX . 'has_courses');
        });
    }
};
