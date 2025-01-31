<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Models\Rating;
use App\State\RatingProvider;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [],
    provider: RatingProvider::class,
    shortName: 'Rating',
)]
class RatingApiResource {
    public function __construct(
        private Rating $rating,
    ) {}

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getId(): int {
        return $this->rating->id;
    }

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getLabel(): string {
        return $this->rating->label;
    }
}
