import { apiClient } from "./api";
import type { Appointment, AppointmentCreate, PaginatedResponse } from "../types";

export const appointmentService = {
  async create(payload: AppointmentCreate): Promise<Appointment> {
    const { data } = await apiClient.post<Appointment>("/appointments", payload);
    return data;
  },

  async list(page = 1, perPage = 10, status?: string): Promise<PaginatedResponse<Appointment>> {
    const params: Record<string, unknown> = { page, per_page: perPage };
    if (status) params.status_filter = status;
    const { data } = await apiClient.get<PaginatedResponse<Appointment>>("/appointments", { params });
    return data;
  },

  async getById(id: number): Promise<Appointment> {
    const { data } = await apiClient.get<Appointment>(`/appointments/${id}`);
    return data;
  },

  async updateStatus(id: number, status: string): Promise<Appointment> {
    const { data } = await apiClient.patch<Appointment>(`/appointments/${id}/status`, { status });
    return data;
  },
};
