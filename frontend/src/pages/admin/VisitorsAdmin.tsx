import { useState } from "react";
import { useQuery } from "@tanstack/react-query";
import { adminService } from "../../services/adminService";
import { LoadingSpinner } from "../../components/ui/LoadingSpinner";
import { Pagination } from "../../components/ui/Pagination";

export default function VisitorsAdmin() {
  const [page, setPage] = useState(1);
  const { data, isLoading } = useQuery({
    queryKey: ["visitors", page],
    queryFn: () => adminService.getVisitors(page, 10),
  });

  return (
    <div className="p-8">
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">Visiteurs</h1>
        <p className="text-gray-500 mt-0.5">Suivi des visiteurs et interactions</p>
      </div>

      {isLoading ? (
        <LoadingSpinner />
      ) : (
        <div className="bg-white rounded-2xl border shadow-card overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead className="bg-gray-50 border-b">
                <tr>
                  {["Nom", "Email", "Type", "Source", "IP", "Date"].map((h) => (
                    <th key={h} className="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{h}</th>
                  ))}
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-50">
                {data?.items.map((v) => (
                  <tr key={v.id_visitor} className="hover:bg-gray-50 transition-colors">
                    <td className="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{v.name_surName}</td>
                    <td className="px-4 py-3 text-gray-600">{v.email}</td>
                    <td className="px-4 py-3">
                      <span className="inline-flex items-center rounded-full bg-blue-100 text-blue-800 px-2.5 py-0.5 text-xs font-medium">
                        {v.visitor_type}
                      </span>
                    </td>
                    <td className="px-4 py-3 text-gray-500">{v.source_page ?? "—"}</td>
                    <td className="px-4 py-3 text-gray-500 font-mono text-xs">{v.ip_address ?? "—"}</td>
                    <td className="px-4 py-3 text-gray-500 whitespace-nowrap">
                      {new Date(v.date_visit).toLocaleString("fr-FR", { dateStyle: "short", timeStyle: "short" })}
                    </td>
                  </tr>
                ))}
                {data?.items.length === 0 && (
                  <tr><td colSpan={6} className="px-4 py-8 text-center text-gray-400">Aucun visiteur enregistré</td></tr>
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
