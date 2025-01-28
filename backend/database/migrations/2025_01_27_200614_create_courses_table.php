<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public const TABLE_NAME = 'croc_courses';
    public const TABLE_PREFIX = 'cour_';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->uuid(self::TABLE_PREFIX . 'id')->primary();
            $table->foreignUuid('manager_user_id')
                ->constrained('users', 'user_id')
            ;
            $table->foreignId('leve_id')
                ->constrained('croc_levels', 'leve_id')
            ;
            $table->foreignUuid('site_id')
                ->constrained('croc_sites', 'site_id')
            ;
            $table->date(self::TABLE_PREFIX . 'start_date');
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
