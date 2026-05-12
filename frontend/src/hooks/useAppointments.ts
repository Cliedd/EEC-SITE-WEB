import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import { appointmentService } from "../services/appointmentService";
import type { AppointmentCreate } from "../types";

export function useAppointments(page = 1, perPage = 10, status?: string) {
  return useQuery({
    queryKey: ["appointments", page, perPage, status],
    queryFn: () => appointmentService.list(page, perPage, status),
  });
}

export function useAppointment(id: number) {
  return useQuery({
    queryKey: ["appointment", id],
    queryFn: () => appointmentService.getById(id),
    enabled: !!id,
  });
}

export function useCreateAppointment() {
  const qc = useQueryClient();
  return useMutation({
    mutationFn: (payload: AppointmentCreate) => appointmentService.create(payload),
    onSuccess: () => qc.invalidateQueries({ queryKey: ["appointments"] }),
  });
}

export function useUpdateAppointmentStatus() {
  const qc = useQueryClient();
  return useMutation({
    mutationFn: ({ id, status }: { id: number; status: string }) =>
      appointmentService.updateStatus(id, status),
    onSuccess: () => qc.invalidateQueries({ queryKey: ["appointments"] }),
  });
}
