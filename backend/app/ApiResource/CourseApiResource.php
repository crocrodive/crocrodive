<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Models\Course;
use App\State\CourseProvider;
use Symfony\Component\Serializer\Attribute\Groups;

/**
 * DTO class for provide courses data to the API
 * @see Course
 */
#[ApiResource(
    operations: [
        new GetCollection(),
    ],
    uriTemplate: '/courses',
    normalizationContext: [
        'groups' => [CourseApiResource::READ_GROUP],
    ],
    provider: CourseProvider::class,
    shortName: 'Course',
)]
class CourseApiResource {
    public const READ_GROUP = 'course:read';

    public function __construct(
        private Course $course,
    ) {}

    #[Groups([self::READ_GROUP])]
    public function getId(): string {
        return $this->course->id;
    }

    #[Groups([self::READ_GROUP])]
    public function getStartDate(): string {
        return $this->course->start_date;
    }

    #[Groups([self::READ_GROUP])]
    public function getSite(): SiteApiResource {
        return new SiteApiResource($this->course->site);
    }

    #[Groups([self::READ_GROUP])]
    public function getSessions(): array {
        return array_map(
            fn($session) => new SessionApiResource($session),
            $this->course->sessions->all(),
        );
    }
}
