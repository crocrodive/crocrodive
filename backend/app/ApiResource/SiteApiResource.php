<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use App\Models\Site;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [],
    shortName: 'Site',
)]
class SiteApiResource {
    public function __construct(
        private Site $site,
    ) {}

    #[Groups([CourseApiResource::READ_GROUP])]
    public function getId(): string {
        return $this->site->id;
    }

    #[Groups([CourseApiResource::READ_GROUP])]
    public function getName(): string {
        return $this->site->name;
    }

    #[Groups([CourseApiResource::READ_GROUP])]
    public function getAddress(): string {
        return $this->site->address;
    }
}
