import axios from "axios";

const BASE_URL = import.meta.env.VITE_API_URL ?? "/api";

/*
 * NOTE SÉCURITÉ : Le token JWT est actuellement stocké dans localStorage.
 * C'est acceptable pour un projet non-critique, mais en production haute sécurité
 * préférer des cookies HttpOnly (nécessite un endpoint /auth/refresh côté backend).
 * S'assurer que la CSP est configurée pour limiter les risques XSS.
 */

export const apiClient = axios.create({
  baseURL: BASE_URL,
  headers: { "Content-Type": "application/json" },
  timeout: 15000,
});

// Inject auth token on every request
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem("token");
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Redirect to login on 401
apiClient.interceptors.response.use(
  (res) => res,
  (error) => {
    if (error.response?.status === 401) {
      localStorage.removeItem("token");
      localStorage.removeItem("auth");
      window.location.href = "/login";
    }
    return Promise.reject(error);
  }
);
