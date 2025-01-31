<?php

namespace App\Http\Controllers\Api;

use App\ApiResource\SessionApiResource;
use App\Enum\GroupEvaluationState;
use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiSessionController extends Controller
{
    public function setEvaluated(Request $request, string $id): JsonResponse
    {
        $session = Session::findOrFail($id);

        $currentUser = auth('sanctum')->user();

        if(! $currentUser instanceof User) {
            return new JsonResponse(['message' => 'Unauthenticated'], 401);
        }

        if(! $currentUser->can('setEvaluated', $session)) {
            return new JsonResponse(['message' => 'Access denied'], 403);
        }

        // Get this user's group for this session
        $sessionApiResource = new SessionApiResource($session);
        $group = $sessionApiResource->getCurrentUserGroup($currentUser);

        if(! $group) {
            return new JsonResponse(['message' => "Vous n'avez pas de groupe de plongeurs pour cette session"], 422);
        }

        if($group->state === GroupEvaluationState::UPCOMING->value) {
            return new JsonResponse(['message' => "Impossible d'évaluer un session future"], 422);
        }

        if($group->state === GroupEvaluationState::EVALUATED->value) {
            return new JsonResponse(['message' => "Ce groupe a déjà été évalué"], 409);
        }

        $group->grou_state = GroupEvaluationState::EVALUATED->value;
        $group->save();

        return new JsonResponse(['message' => 'success']);
    }
}
