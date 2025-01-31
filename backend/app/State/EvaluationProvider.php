<?php

namespace App\State;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\EvaluationApiResource;
use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Collection;

final class EvaluationProvider implements ProviderInterface
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
     * @return EvaluationApiResource[]
     */
    private function provideCollection(Operation $operation, array $uriVariables = [], array $context = []): array {
        return [];
    }

    private function provideItem(Operation $operation, array $uriVariables = [], array $context = []): ?EvaluationApiResource {
        $id = $uriVariables['id'] ?? null;

        if(! $id) {
            return null;
        }

        $evalution = Evaluation::find($id);
        if($evalution instanceof Collection) {
            return new EvaluationApiResource($evalution->first());
        }

        if(! $evalution instanceof Evaluation) {
            return null;
        }

        return new EvaluationApiResource($evalution);
    }
}
