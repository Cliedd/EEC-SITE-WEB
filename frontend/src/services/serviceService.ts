import { apiClient } from "./api";
import type { Service } from "../types";

export const serviceService = {
  async list(activeOnly = true): Promise<Service[]> {
    const { data } = await apiClient.get<Service[]>("/services", {
      params: { active_only: activeOnly },
    });
    return data;
  },

  async toggle(id: number): Promise<Service> {
    const { data } = await apiClient.patch<Service>(`/services/${id}/toggle`);
    return data;
  },

  async create(payload: Partial<Service>): Promise<Service> {
    const { data } = await apiClient.post<Service>("/services", payload);
    return data;
  },

  async update(id: number, payload: Partial<Service>): Promise<Service> {
    const { data } = await apiClient.patch<Service>(`/services/${id}`, payload);
    return data;
  },

  async delete(id: number): Promise<void> {
    await apiClient.delete(`/services/${id}`);
  },
};
