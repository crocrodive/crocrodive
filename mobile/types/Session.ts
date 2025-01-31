import { z } from 'zod';
import { evaluationSchema } from './Evaluation';

export const instructorSchema = z.object({
    firstname: z.string(),
    lastname: z.string(),
});

export type Instructor = z.infer<typeof instructorSchema>;

export const attendeeSchema = z.object({
    firstname: z.string(),
    lastname: z.string(),
    evaluations: z.array(evaluationSchema),
});

export type Attendee = z.infer<typeof attendeeSchema>;

export const sessionSchema = z.object({
    id: z.string(),
    date: z.string(),
    instructor: instructorSchema,
    attendees: z.array(attendeeSchema),
    state: z.number(),
});

export type Session = z.infer<typeof sessionSchema>;
