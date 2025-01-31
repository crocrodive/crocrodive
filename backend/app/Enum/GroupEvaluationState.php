<?php

namespace App\Enum;

enum GroupEvaluationState: int {
    case UPCOMING = 0;
    case TO_BE_EVALUATED = 1;
    case EVALUATED = 2;

    public static function fromValue(int $value): ?GroupEvaluationState
    {
        foreach (self::cases() as $state) {
            if( $value === $state->value ){
                return $state;
            }
        }
        return null;
    }
}
