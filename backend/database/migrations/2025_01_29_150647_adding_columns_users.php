<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public const TABLE_NAME = 'users';
    public const TABLE_PREFIX = 'user_';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Add columns code postal and ville to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string(self::TABLE_PREFIX .'postal_code', 5);
            $table->string(self::TABLE_PREFIX. 'city', 128);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(self::TABLE_PREFIX . 'postal_code');
            $table->dropColumn(self::TABLE_PREFIX . 'city');
        });
    }
};
