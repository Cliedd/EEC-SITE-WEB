import axios from "axios";

const BASE_URL = "/api";

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

// Déconnexion sur 401 — UNIQUEMENT pour une session expirée sur une vraie ressource.
// On n'agit PAS sur les échecs de connexion (gérés par la page Login) pour éviter
// un rechargement brutal en pleine séquence de login (essai admin puis patient),
// et on ne redirige pas si l'on est déjà sur /login (évite la boucle).
apiClient.interceptors.response.use(
  (res) => res,
  (error) => {
    const url: string = error.config?.url ?? "";
    const isAuthRequest = url.includes("/auth/login") || url.includes("/auth/admin/login");
    if (error.response?.status === 401 && !isAuthRequest) {
      localStorage.removeItem("token");
      localStorage.removeItem("auth");
      if (window.location.pathname !== "/login") {
        window.location.href = "/login";
      }
    }
    return Promise.reject(error);
  }
);
