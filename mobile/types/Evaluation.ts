import { z } from 'zod';
import { ratingSchema } from './Rating';
import { abilitySchema } from './Ability';

export const evaluationSchema = z.object({
    id: z.string(),
    rating: ratingSchema,
    ability: abilitySchema,
    comment: z.string().optional(),
});

export type Evaluation = z.infer<typeof evaluationSchema>;
