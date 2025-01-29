<?php

namespace App\Enum;

enum Roles: string {
    case TECHNICAL_DIRECTOR = "Technical Director";
    case COURSE_MANAGER = "Course Manager";
    case INSTRUCTOR = "Instructor";
    case ATTENDEE = "Attendee";
}