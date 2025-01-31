<?php

namespace App\State;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\CourseApiResource;
use App\Models\User;

class CourseProvider implements ProviderInterface {
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if($operation instanceof GetCollection) {
            return $this->provideCollection($operation, $uriVariables, $context);
        }

        return $this->provideItem($operation, $uriVariables, $context);
    }

    /**
     * Fetch the course where the user participate (as attendee or instructor)
     * @param \ApiPlatform\Metadata\Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return CourseApiResource[]
     */
    private function provideCollection(Operation $operation, array $uriVariables = [], array $context = []): array {
        $user = auth('sanctum')->user();

        if(! $user instanceof User) {
            return [];
        }

        return array_map(function($course) {
            return new CourseApiResource($course);
        }, $user->courses->all());
    }

    private function provideItem(Operation $operation, array $uriVariables = [], array $context = []): CourseApiResource|null {
        return null;
    }
}
