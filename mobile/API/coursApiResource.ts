import { api } from './api';
import { Course, courseSchema } from "@/types/Course";
import { z } from 'zod';

export const fetchCourses = async (): Promise<Course[]> => {
  try {
    const response = await api.get("/courses");

    const schema = z.object({member: z.array(courseSchema)});

    const parsing = schema.safeParse(response.data);
    if(parsing.success) {
      return parsing.data.member;
    }

    console.error(parsing.error);

    return response.data.member as Course[];
  } catch (error) {
    throw error;
  }
};
