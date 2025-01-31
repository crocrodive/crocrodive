import { AxiosResponse } from "axios";
import { api } from "./api";

export async function setSessionEvaluated(sessionId: string): Promise<AxiosResponse> {
    return api.patch(`/api/session/${sessionId}/set_evaluated`);
}
