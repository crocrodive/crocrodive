<?php

namespace App\Enum;

enum Roles: string {
    case TECHNICAL_DIRECTOR = "Directeur Technique";
    case COURSE_MANAGER = "Responsable de formation";
    case INSTRUCTOR = "Initiateur";
    case ATTENDEE = "Élève";
}