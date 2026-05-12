import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import { contactService } from "../services/contactService";
import type { ContactCreate } from "../types";

export function useContacts(page = 1, perPage = 10) {
  return useQuery({
    queryKey: ["contacts", page, perPage],
    queryFn: () => contactService.list(page, perPage),
  });
}

export function useCreateContact() {
  return useMutation({
    mutationFn: (payload: ContactCreate) => contactService.create(payload),
  });
}

export function useUpdateContactStatus() {
  const qc = useQueryClient();
  return useMutation({
    mutationFn: ({ id, status }: { id: number; status: string }) =>
      contactService.updateStatus(id, status),
    onSuccess: () => qc.invalidateQueries({ queryKey: ["contacts"] }),
  });
}
