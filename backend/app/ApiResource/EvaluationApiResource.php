<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Patch;
use App\Http\Requests\Api\ApiPatchEvaluationRequest;
use App\Models\Evaluation;
use App\Policies\ApiEvaluationPolicy;
use App\State\EvaluationProvider;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [
        new Patch(
            policy: 'update',
            denormalizationContext: ['groups' => [EvaluationApiResource::EDIT_GROUP]],
            output: false,
            status: 200,
            rules: ApiPatchEvaluationRequest::class,
        ),
    ],
    shortName: 'Evaluation',
    provider: EvaluationProvider::class,
    policy: ApiEvaluationPolicy::class,
)]
class EvaluationApiResource {
    public const EDIT_GROUP = 'evaluation:edit';
    public const PATCH_VALIDATION_GROUP = 'evaluation:patch-validation';

    public function __construct(
        private Evaluation $evaluation,
    ) {}

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getId(): string {
        return $this->evaluation->id;
    }

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getRating(): RatingApiResource {
        return new RatingApiResource($this->evaluation->rating);
    }

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getAbility(): AbilityApiResource {
        return new AbilityApiResource($this->evaluation->ability);
    }

    #[Groups(CourseApiResource::READ_GROUP)]
    public function getComment(): ?string {
        return $this->evaluation->comment;
    }

    #[Groups(self::EDIT_GROUP)]
    public function setComment(string $comment): void {
        $this->evaluation->eval_comment = $comment;
        $this->evaluation->save();
    }

    #[Groups(self::EDIT_GROUP)]
    public function setRating(RatingApiResource $rating): void {
        $this->evaluation->rati_id = $rating->getId();
        $this->evaluation->save();
    }
}
