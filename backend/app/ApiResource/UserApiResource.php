<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use App\Models\Session;
use App\Models\User;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [],
    shortName: 'User',
)]
class UserApiResource {
    public function __construct(
        private User $user,
        private ?Session $currentsession = null,
    ) {}

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getFirstname(): string {
        return $this->user->user_firstname;
    }

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getLastname(): string {
        return $this->user->user_lastname;
    }

    /**
     * Get the evaluations for the session given in constructor
     * @return EvaluationApiResource[]
     */
    #[Groups(CourseApiResource::READ_GROUP)]
    public function getEvaluations(): array {
        if(! $this->currentsession) {
            return [];
        }

        $evaluations = $this->currentsession->evaluations()
            ->where('user_id', $this->user->user_id)
            ->get()
            ->all()
        ;

        return array_map(
            fn($evaluation) => new EvaluationApiResource($evaluation),
            $evaluations,
        );
    }
}
