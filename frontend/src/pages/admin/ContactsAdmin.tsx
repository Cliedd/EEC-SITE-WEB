import { useState } from "react";
import { useContacts, useUpdateContactStatus } from "../../hooks/useContacts";
import { LoadingSpinner } from "../../components/ui/LoadingSpinner";
import { statusBadge } from "../../components/ui/Badge";
import { Button } from "../../components/ui/Button";
import { Pagination } from "../../components/ui/Pagination";
import toast from "react-hot-toast";

export default function ContactsAdmin() {
  const [page, setPage] = useState(1);
  const { data, isLoading } = useContacts(page, 10);
  const { mutateAsync: updateStatus } = useUpdateContactStatus();

  const markAs = async (id: number, status: string) => {
    try {
      await updateStatus({ id, status });
      toast.success("Statut mis à jour");
    } catch {
      toast.error("Erreur");
    }
  };

  return (
    <div className="p-8">
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">Messages de Contact</h1>
        <p className="text-gray-500 mt-0.5">Messages reçus via le formulaire de contact</p>
      </div>

      {isLoading ? (
        <LoadingSpinner />
      ) : (
        <div className="bg-white rounded-2xl border shadow-card overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead className="bg-gray-50 border-b">
                <tr>
                  {["Expéditeur", "Email", "Objet", "Date", "Statut", "Actions"].map((h) => (
                    <th key={h} className="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                      {h}
                    </th>
                  ))}
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-50">
                {data?.items.map((contact) => (
                  <tr key={contact.id_contact} className="hover:bg-gray-50 transition-colors">
                    <td className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{contact.name_surName}</td>
                    <td className="px-4 py-3 text-gray-600">{contact.email}</td>
                    <td className="px-4 py-3 text-gray-700 max-w-xs truncate">{contact.objet}</td>
                    <td className="px-4 py-3 text-gray-500 whitespace-nowrap">
                      {new Date(contact.date_creation).toLocaleDateString("fr-FR")}
                    </td>
                    <td className="px-4 py-3">{statusBadge(contact.status)}</td>
                    <td className="px-4 py-3">
                      <div className="flex gap-1">
                        {contact.status === "unread" && (
                          <Button size="sm" variant="outline" onClick={() => markAs(contact.id_contact, "read")}>Marquer lu</Button>
                        )}
                        {contact.status !== "replied" && (
                          <Button size="sm" variant="ghost" onClick={() => markAs(contact.id_contact, "replied")}>Répondu</Button>
                        )}
                      </div>
                    </td>
                  </tr>
                ))}
                {data?.items.length === 0 && (
                  <tr>
                    <td colSpan={6} className="px-4 py-8 text-center text-gray-400">Aucun message</td>
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
