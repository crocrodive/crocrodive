<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Patch;
use App\Enum\GroupEvaluationState;
use App\Enum\Roles;
use App\Models\DivingGroup;
use App\Models\Session;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [
        new Patch(
            uriTemplate: '/sessions/{id}/set_evaluated',
        ),
    ],
    shortName: 'Session',
)]
class SessionApiResource
{
    private ?DivingGroup $currentUserGroup = null;

    public function __construct(
        private Session $session,
    ) {}

    #[Groups([CourseApiResource::READ_GROUP])]
    public function getId(): string {
        return $this->session->id;
    }

    #[Groups([CourseApiResource::READ_GROUP])]
    public function getDate(): string {
        return $this->session->date;
    }

    #[Groups([CourseApiResource::READ_GROUP])]
    public function getInstructor(): ?UserApiResource {
        $currentUser = auth('sanctum')->user();
        if(! $currentUser instanceof User) {
            return throw new AuthenticationException();
        }

        // If the current user is an instructor, return themself
        if(Roles::fromValue($currentUser->role_id)?->isInstructor()) {
                return new UserApiResource($currentUser);
        }

        $group = self::getCurrentUserGroup($currentUser);

        if(! $group) {
            return null;
        }

        return new UserApiResource($group->instructor);
    }

    /**
     * 
     * @return UserApiResource[]
     */
    #[Groups(CourseApiResource::READ_GROUP)]
    public function getAttendees(): array {
        $currentUser = auth('sanctum')->user();

        if(! $currentUser instanceof User) {
            return throw new AuthenticationException();
        }

        $role = Roles::fromValue($currentUser->role_id);

        if(! $role || ! $role->isInstructor()) {
            return [new UserApiResource($currentUser, $this->session)];
        }

        $group = self::getCurrentUserGroup($currentUser);

        return array_map(
            fn(User $attendee) => new UserApiResource($attendee, $this->session),
            $group->attendees->all(),
        );
    }

    /**
     * Get the state of the current user's group for this session.
     */
    #[Groups([CourseApiResource::READ_GROUP])]
    public function getState(): int {
        $currentUser = auth('sanctum')->user();

        if(! $currentUser instanceof User) {
            throw new AuthenticationException();
        }

        $group = self::getCurrentUserGroup($currentUser);

        if(! $group) {
            return 0;
        }

        $state = $group->state;

        // If the session is in the future, the state is UPCOMING
        if($this->session->date > now()) {
            return GroupEvaluationState::UPCOMING->value;
        }

        // If the session is in the past, the state is either EVALUATED or TO_BE_EVALUATED
        // Force it to TO_BE_EVALUATED by default
        if($state === GroupEvaluationState::UPCOMING->value) {
            return GroupEvaluationState::TO_BE_EVALUATED->value;
        }

        return $state;
    }

    public function getCurrentUserGroup(User $currentUser): ?DivingGroup {
        if($this->currentUserGroup) {
            return $this->currentUserGroup;
        }

        $isInstructor = Roles::fromValue($currentUser->role_id)?->isInstructor();

        $groups = $this->session->diving_groups;

        if($isInstructor) {
            return $groups->first(fn (DivingGroup $group): bool => 
                $group->instructor->user_id === $currentUser->user_id
            );
        }

        return $groups->first(function (DivingGroup $group) use ($currentUser) {
            $hasUser = false;
            $attendees = $group->attendees;
            foreach($attendees as $attendee) {
                if($attendee->user_id === $currentUser->user_id) {
                    $hasUser = true;
                    break;
                }
            }
            return $hasUser;
        });
    }
}
