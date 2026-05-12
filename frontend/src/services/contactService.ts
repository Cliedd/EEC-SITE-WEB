import { apiClient } from "./api";
import type { Contact, ContactCreate, PaginatedResponse } from "../types";

export const contactService = {
  async create(payload: ContactCreate): Promise<Contact> {
    const { data } = await apiClient.post<Contact>("/contacts", payload);
    return data;
  },

  async list(page = 1, perPage = 10): Promise<PaginatedResponse<Contact>> {
    const { data } = await apiClient.get<PaginatedResponse<Contact>>("/contacts", {
      params: { page, per_page: perPage },
    });
    return data;
  },

  async updateStatus(id: number, status: string): Promise<void> {
    await apiClient.patch(`/contacts/${id}/status`, { status });
  },
};
