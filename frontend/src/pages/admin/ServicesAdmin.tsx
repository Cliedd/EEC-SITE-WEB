import { useState } from "react";
import { Plus, ToggleLeft, ToggleRight, Trash2 } from "lucide-react";
import { useServices, useToggleService, useCreateService, useDeleteService } from "../../hooks/useServices";
import { LoadingSpinner } from "../../components/ui/LoadingSpinner";
import { Button } from "../../components/ui/Button";
import { Input } from "../../components/ui/Input";
import toast from "react-hot-toast";

export default function ServicesAdmin() {
  const { data: services, isLoading } = useServices(false);
  const { mutateAsync: toggle } = useToggleService();
  const { mutateAsync: create, isPending: creating } = useCreateService();
  const { mutateAsync: remove } = useDeleteService();
  const [newName, setNewName] = useState("");
  const [newDesc, setNewDesc] = useState("");

  const handleCreate = async () => {
    if (!newName.trim()) return;
    try {
      await create({ name: newName.trim(), description: newDesc.trim() || undefined, is_active: 1 });
      toast.success("Service créé");
      setNewName(""); setNewDesc("");
    } catch {
      toast.error("Erreur lors de la création");
    }
  };

  const handleToggle = async (id: number) => {
    try { await toggle(id); toast.success("Statut mis à jour"); }
    catch { toast.error("Erreur"); }
  };

  const handleDelete = async (id: number) => {
    if (!confirm("Supprimer ce service ?")) return;
    try { await remove(id); toast.success("Service supprimé"); }
    catch { toast.error("Erreur"); }
  };

  return (
    <div className="p-8">
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">Services Médicaux</h1>
        <p className="text-gray-500 mt-0.5">Gérer les services disponibles</p>
      </div>

      {/* Add new */}
      <div className="bg-white rounded-2xl border shadow-card p-6 mb-6">
        <h2 className="font-semibold text-gray-800 mb-4 flex items-center gap-2">
          <Plus className="h-5 w-5 text-primary-500" /> Ajouter un service
        </h2>
        <div className="grid gap-4 sm:grid-cols-2">
          <Input label="Nom du service" value={newName} onChange={(e) => setNewName(e.target.value)} placeholder="Ex: Cardiologie" />
          <Input label="Description" value={newDesc} onChange={(e) => setNewDesc(e.target.value)} placeholder="Brève description" />
        </div>
        <Button onClick={handleCreate} loading={creating} className="mt-4" disabled={!newName.trim()}>
          Créer le service
        </Button>
      </div>

      {isLoading ? (
        <LoadingSpinner />
      ) : (
        <div className="bg-white rounded-2xl border shadow-card overflow-hidden">
          <table className="w-full text-sm">
            <thead className="bg-gray-50 border-b">
              <tr>
                {["Service", "Description", "Statut", "Actions"].map((h) => (
                  <th key={h} className="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{h}</th>
                ))}
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-50">
              {services?.map((s) => (
                <tr key={s.id} className="hover:bg-gray-50 transition-colors">
                  <td className="px-4 py-3 font-medium text-gray-900">{s.name}</td>
                  <td className="px-4 py-3 text-gray-500 max-w-xs truncate">{s.description ?? "—"}</td>
                  <td className="px-4 py-3">
                    <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${s.is_active ? "bg-green-100 text-green-800" : "bg-gray-100 text-gray-600"}`}>
                      {s.is_active ? "Actif" : "Inactif"}
                    </span>
                  </td>
                  <td className="px-4 py-3">
                    <div className="flex gap-2">
                      <Button size="sm" variant="ghost" onClick={() => handleToggle(s.id)}>
                        {s.is_active ? <ToggleRight className="h-5 w-5 text-green-600" /> : <ToggleLeft className="h-5 w-5 text-gray-400" />}
                      </Button>
                      <Button size="sm" variant="danger" onClick={() => handleDelete(s.id)}>
                        <Trash2 className="h-4 w-4" />
                      </Button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}
