<?php

namespace App\Http\Requests\Api;

use App\Enum\GroupEvaluationState;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ApiPatchEvaluationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => ['string'],
        ];
    }

    public function after(): array {
        return [function (Validator $validator) {
            $state = self::getGroupState();

            if ($state === null) {
                throw new Exception('Unexpected state of group.');
            }

            if($state === GroupEvaluationState::EVALUATED) {
                throw new BadRequestHttpException('You cannot evaluate a group that has already been evaluated.');
            }

            if($state === GroupEvaluationState::UPCOMING) {
                throw new BadRequestHttpException( 'You can only evaluate groups that have already been diving.');
            }
        }];
    }

    private function getGroupState(): GroupEvaluationState | null {
        $evaluationId = $this->route('id');

        $groupState = DB::table('croc_evaluations')
            ->join('croc_diving_groups', 'croc_evaluations.sess_id', '=', 'croc_diving_groups.sess_id')
            ->join('croc_users_groups', function ($join) {
                $join->on('croc_evaluations.user_id', '=', 'croc_users_groups.user_id')
                    ->on('croc_diving_groups.grou_id', '=', 'croc_users_groups.grou_id');
            })
            ->where('croc_evaluations.eval_id', '=', $evaluationId)
            ->value('grou_state');

        return GroupEvaluationState::fromValue($groupState);
    }
}
