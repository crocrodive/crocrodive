import { z } from 'zod';
import { siteSchema } from './Site';
import { sessionSchema } from './Session';

export const courseSchema = z.object({
    id: z.string(),
    startDate: z.string(),
    site: siteSchema,
    sessions: z.array(sessionSchema),
});

export type Course = z.infer<typeof courseSchema>;
