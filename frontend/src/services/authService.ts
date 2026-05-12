import { apiClient } from "./api";

export interface LoginPayload {
  email: string;
  mot_de_passe: string;
}

export interface RegisterPayload {
  name_surName: string;
  email: string;
  telephone: string;
  mot_de_passe: string;
}

export interface TokenResponse {
  access_token: string;
  token_type: string;
  user_name: string;
  role: string;
}

export const authService = {
  async login(payload: LoginPayload): Promise<TokenResponse> {
    const { data } = await apiClient.post<TokenResponse>("/auth/login", payload);
    return data;
  },

  async adminLogin(payload: LoginPayload): Promise<TokenResponse> {
    const { data } = await apiClient.post<TokenResponse>("/auth/admin/login", payload);
    return data;
  },

  async register(payload: RegisterPayload): Promise<void> {
    await apiClient.post("/auth/register", payload);
  },
};
