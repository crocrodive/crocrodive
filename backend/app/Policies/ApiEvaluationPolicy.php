<?php

namespace App\Policies;

use App\ApiResource\EvaluationApiResource;
use App\Enum\Roles;
use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ApiEvaluationPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EvaluationApiResource $evaluation): bool
    {
        if(! Roles::fromValue($user->role_id)->isInstructor()) {
            return false;
        }

        $instructorId = DB::table('croc_evaluations')
            ->join('croc_diving_groups', 'croc_evaluations.sess_id', '=', 'croc_diving_groups.sess_id')
            ->join('croc_users_groups', function ($join) {
                $join->on('croc_evaluations.user_id', '=', 'croc_users_groups.user_id')
                    ->on('croc_diving_groups.grou_id', '=', 'croc_users_groups.grou_id');
            })
            ->where('croc_evaluations.eval_id', '=', $evaluation->getId())
            ->value('instructor_user_id');

        return $instructorId === $user->user_id;
    }
}
