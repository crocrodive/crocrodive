<?php

namespace App\Enum;

enum Roles: string {
    case TECHNICAL_DIRECTOR = "Directeur Technique";
    case COURSE_MANAGER = "Responsable de formation";
    case INSTRUCTOR = "Initiateur";
    case ATTENDEE = "Élève";

    /**
     * Tell if the role has at least instructor rights
     * @return void
     */
    public function isInstructor(): bool {
        return match($this) {
            self::INSTRUCTOR, self::COURSE_MANAGER, self::TECHNICAL_DIRECTOR => true,
            default => false,
        };
    }

    public static function fromValue(string $value): ?Roles
    {
        foreach (self::cases() as $role) {
            if( $value === $role->value ){
                return $role;
            }
        }
        return null;
    }
}
