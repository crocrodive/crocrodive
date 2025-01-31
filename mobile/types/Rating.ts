import { z } from 'zod';

export const ratingSchema = z.object({
    id: z.number(),
    label: z.string(),
});

export type Rating = z.infer<typeof ratingSchema>;
