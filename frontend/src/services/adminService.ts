import { apiClient } from "./api";
import type { DashboardStats, Visitor, AuditLog, PaginatedResponse } from "../types";

export const adminService = {
  async getStats(): Promise<DashboardStats> {
    const { data } = await apiClient.get<DashboardStats>("/admin/stats");
    return data;
  },

  async getVisitors(page = 1, perPage = 10): Promise<PaginatedResponse<Visitor>> {
    const { data } = await apiClient.get<PaginatedResponse<Visitor>>("/admin/visitors", {
      params: { page, per_page: perPage },
    });
    return data;
  },

  async getAuditLogs(page = 1, perPage = 20, action?: string): Promise<PaginatedResponse<AuditLog>> {
    const params: Record<string, unknown> = { page, per_page: perPage };
    if (action) params.action_filter = action;
    const { data } = await apiClient.get<PaginatedResponse<AuditLog>>("/admin/audit-logs", { params });
    return data;
  },

  async getAccounts(page = 1, perPage = 10): Promise<PaginatedResponse<Record<string, unknown>>> {
    const { data } = await apiClient.get("/admin/accounts", {
      params: { page, per_page: perPage },
    });
    return data;
  },
};
