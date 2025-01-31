<?php

namespace App\Policies;

use App\Enum\Roles;
use App\Models\Session;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SessionPolicy
{
    public function setEvaluated(User $user, Session $session): Response
    {
        // Deny request from non-instructors (ex: attendees)
        if(! Roles::fromValue($user->role_id)?->isInstructor()) {
            return Response::deny();
        }

        // Deny request from instructors who are not in this course
        $courseUsers = $session->course->users;
        if(! $courseUsers->contains($user)) {
            return Response::deny();
        }

        return Response::allow();
    }
}
