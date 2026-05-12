import { useState } from "react";
import { useAppointments, useUpdateAppointmentStatus } from "../../hooks/useAppointments";
import { LoadingSpinner } from "../../components/ui/LoadingSpinner";
import { statusBadge } from "../../components/ui/Badge";
import { Button } from "../../components/ui/Button";
import { Pagination } from "../../components/ui/Pagination";
import toast from "react-hot-toast";

export default function AppointmentsAdmin() {
  const [page, setPage] = useState(1);
  const [statusFilter, setStatusFilter] = useState<string>("");
  const { data, isLoading } = useAppointments(page, 10, statusFilter || undefined);
  const { mutateAsync: updateStatus } = useUpdateAppointmentStatus();

  const handleStatus = async (id: number, status: string) => {
    try {
      await updateStatus({ id, status });
      toast.success("Statut mis à jour");
    } catch {
      toast.error("Erreur lors de la mise à jour");
    }
  };

  return (
    <div className="p-8">
      <div className="flex items-center justify-between mb-6">
        <div>
          <h1 className="text-2xl font-bold text-gray-900">Rendez-vous</h1>
          <p className="text-gray-500 mt-0.5">Gestion des demandes de rendez-vous</p>
        </div>
        <select
          className="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-primary-500 focus:outline-none"
          value={statusFilter}
          onChange={(e) => { setStatusFilter(e.target.value); setPage(1); }}
        >
          <option value="">Tous les statuts</option>
          <option value="pending">En attente</option>
          <option value="confirmed">Confirmés</option>
          <option value="cancelled">Annulés</option>
          <option value="completed">Terminés</option>
        </select>
      </div>

      {isLoading ? (
        <LoadingSpinner />
      ) : (
        <div className="bg-white rounded-2xl border shadow-card overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead className="bg-gray-50 border-b">
                <tr>
                  {["Patient", "Email", "Téléphone", "Service", "Date", "Statut", "Actions"].map((h) => (
                    <th key={h} className="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                      {h}
                    </th>
                  ))}
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-50">
                {data?.items.map((appt) => (
                  <tr key={appt.id_appointment} className="hover:bg-gray-50 transition-colors">
                    <td className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{appt.name_surName}</td>
                    <td className="px-4 py-3 text-gray-600">{appt.email}</td>
                    <td className="px-4 py-3 text-gray-600 whitespace-nowrap">{appt.telephone}</td>
                    <td className="px-4 py-3 text-gray-600">{appt.service ?? "—"}</td>
                    <td className="px-4 py-3 text-gray-600 whitespace-nowrap">
                      {new Date(appt.date_appointment).toLocaleDateString("fr-FR", { day: "2-digit", month: "short", year: "numeric" })}
                    </td>
                    <td className="px-4 py-3">{statusBadge(appt.status)}</td>
                    <td className="px-4 py-3">
                      <div className="flex gap-1 flex-wrap">
                        {appt.status !== "confirmed" && (
                          <Button size="sm" variant="outline" onClick={() => handleStatus(appt.id_appointment, "confirmed")}>Confirmer</Button>
                        )}
                        {appt.status !== "cancelled" && (
                          <Button size="sm" variant="danger" onClick={() => handleStatus(appt.id_appointment, "cancelled")}>Annuler</Button>
                        )}
                      </div>
                    </td>
                  </tr>
                ))}
                {data?.items.length === 0 && (
                  <tr>
                    <td colSpan={7} className="px-4 py-8 text-center text-gray-400">
                      Aucun rendez-vous trouvé
                    </td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
          <div className="px-4 pb-4">
            <Pagination page={page} totalPages={data?.total_pages ?? 1} onPageChange={setPage} />
          </div>
        </div>
      )}
    </div>
  );
}
