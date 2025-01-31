import { z } from 'zod';

export const siteSchema = z.object({
    id: z.string(),
    name: z.string(),
    address: z.string(),
});

export type Site = z.infer<typeof siteSchema>;
