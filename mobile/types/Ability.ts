import { z } from 'zod';

export const abilitySchema = z.object({
    id: z.string(),
    label: z.string(),
});

export type Ability = z.infer<typeof abilitySchema>;
