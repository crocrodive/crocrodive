<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * A user of the application.
 *
 * TL:DR, users of either attendees ("élèves") or instructors ("initiateurs").
 *
 * They are all members of the diving club.
 *
 * @property string $user_id Identifier of the user in DB (UUIDv4)
 * @property string $role_id The role of the user
 * @property int $leve_id The level of the user
 * @property string $user_lastname The last name of the user
 * @property string $user_firstname The first name of the user
 * @property string $user_telephone The phone number of the user
 * @property string $email The email of the user
 * @property string $password The password (hashed) of the user
 * @property bool $user_is_password_temporary Whether the password is temporary or not
 * @property string $user_diploma_date The date of the latest level acquired by the user.
 * This will be used to get the recap of all courses by the technical director.
 * @property string $user_address The address of the user
 * @property string $user_birth_date The birth date of the user
 * @property string $user_diving_license_number The diving license number of the user
 * @see \App\Enum\Roles
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'leve_id',
        'user_lastname',
        'user_firstname',
        'user_telephone',
        'email',
        'password',
        'user_is_password_temporary',
        'user_diploma_date',
        'user_address',
        'user_birth_date',
        'user_diving_license_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

        /**
     * The attributes that should have default values.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'user_is_password_temporary' => true,
    ];
}
