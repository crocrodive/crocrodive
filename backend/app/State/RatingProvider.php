<?php

namespace App\State;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\RatingApiResource;
use App\Models\Rating;

final class RatingProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if($operation instanceof GetCollection) {
            return $this->provideCollection($operation, $uriVariables, $context);
        }

        return $this->provideItem($operation, $uriVariables, $context);
    }

    /**
     * @param \ApiPlatform\Metadata\Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return RatingApiResource[]
     */
    private function provideCollection(Operation $operation, array $uriVariables = [], array $context = []): array {
        return [];
    }

    private function provideItem(Operation $operation, array $uriVariables = [], array $context = []): ?RatingApiResource {
        $id = $uriVariables['id'] ?? null;

        if(! $id) {
            return null;
        }

        $rating = Rating::find($id);
        if($rating instanceof Collection) {
            return new RatingApiResource($rating->first());
        }

        if(! $rating instanceof Rating) {
            return null;
        }

        return new RatingApiResource($rating);
    }
}
