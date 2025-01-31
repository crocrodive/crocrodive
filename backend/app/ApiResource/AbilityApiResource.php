<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use App\Models\Ability;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [],
    shortName: 'Ability',
)]
class AbilityApiResource {
    public function __construct(
        private Ability $ability,
    ) {}

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getId(): string {
        return $this->ability->id;
    }

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getLabel(): string {
        return $this->ability->label;
    }
}
