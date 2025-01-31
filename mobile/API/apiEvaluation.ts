import { AxiosResponse } from "axios";
import { api } from "./api";

type EvaluationPatch = {
    comment?: string;
    ratingId?: number;
}

export async function patchEvaluation(evaluationId: string, evaluationPatch: EvaluationPatch): Promise<AxiosResponse> {
    const body = {
        comment: evaluationPatch.comment,
        ratingId: evaluationPatch.ratingId ? `/api/ratings/${evaluationPatch.ratingId}` : undefined,
    };

    return api.patch(`/evaluations/${evaluationId}`, body);
}
