import axios, { AxiosError } from "axios";
import { useRootNavigationState, useRouter } from "expo-router";
import { api } from './api';

export const fetchCurrentUser = async () => {
  try {
    const response = await api.get("/users/me");
    return response.data;
  } catch (error) {
    throw error;
  }
};

export type LoginSchema = {
  token: string,
}

export type ConnectReturnType = {
  data: LoginSchema,
  error: null,
} | {
  data: null,
  error: AxiosError,
}

export async function connect(email : string, password : string): Promise<ConnectReturnType> {
  try {
    const response = await api.post("/login", {email, password, device_name : "phone"});
    return {
      data: response.data as LoginSchema,
      error: null,
    };
  } catch (error) {
    return {
      data: null,
      error: error as AxiosError,
    }
  }
}
