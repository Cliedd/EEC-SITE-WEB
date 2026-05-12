import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import { serviceService } from "../services/serviceService";
import type { Service } from "../types";

export function useServices(activeOnly = true) {
  return useQuery({
    queryKey: ["services", activeOnly],
    queryFn: () => serviceService.list(activeOnly),
    staleTime: 5 * 60 * 1000,
  });
}

export function useToggleService() {
  const qc = useQueryClient();
  return useMutation({
    mutationFn: (id: number) => serviceService.toggle(id),
    onSuccess: () => qc.invalidateQueries({ queryKey: ["services"] }),
  });
}

export function useCreateService() {
  const qc = useQueryClient();
  return useMutation({
    mutationFn: (payload: Partial<Service>) => serviceService.create(payload),
    onSuccess: () => qc.invalidateQueries({ queryKey: ["services"] }),
  });
}

export function useDeleteService() {
  const qc = useQueryClient();
  return useMutation({
    mutationFn: (id: number) => serviceService.delete(id),
    onSuccess: () => qc.invalidateQueries({ queryKey: ["services"] }),
  });
}
