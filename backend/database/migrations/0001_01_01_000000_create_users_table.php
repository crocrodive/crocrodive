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
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->uuid(self::TABLE_PREFIX . 'id')->primary();
            $table->char('role_id', 36); // Assurez-vous que la taille correspond
            $table->unsignedBigInteger('leve_id'); // Colonne non signée pour correspondre à la clé étrangère
            $table->string(self::TABLE_PREFIX . 'lastname');
            $table->string(self::TABLE_PREFIX . 'firstname');
            $table->string(self::TABLE_PREFIX . 'telephone');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string(self::TABLE_PREFIX . 'is_password_temporary');
            $table->timestamp(self::TABLE_PREFIX . 'diploma_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
