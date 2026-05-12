import { useQuery } from "@tanstack/react-query";
import { Calendar, Users, MessageSquare, Clock, UserCheck } from "lucide-react";
import { adminService } from "../../services/adminService";
import { LoadingSpinner } from "../../components/ui/LoadingSpinner";

interface StatCardProps {
  label: string;
  value: number | string;
  icon: React.FC<{ className?: string }>;
  color: string;
  sub?: string;
}

function StatCard({ label, value, icon: Icon, color, sub }: StatCardProps) {
  return (
    <div className="bg-white rounded-2xl border shadow-card p-6">
      <div className="flex items-center justify-between mb-4">
        <p className="text-sm font-medium text-gray-500">{label}</p>
        <div className={`h-10 w-10 flex items-center justify-center rounded-xl ${color}`}>
          <Icon className="h-5 w-5 text-white" />
        </div>
      </div>
      <p className="text-3xl font-bold text-gray-900">{value}</p>
      {sub && <p className="text-xs text-gray-400 mt-1">{sub}</p>}
    </div>
  );
}

export default function AdminDashboard() {
  const { data: stats, isLoading } = useQuery({
    queryKey: ["admin-stats"],
    queryFn: adminService.getStats,
    refetchInterval: 30000,
  });

  if (isLoading) return <LoadingSpinner className="py-32" />;

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-2xl font-bold text-gray-900">Tableau de Bord</h1>
        <p className="text-gray-500 mt-1">Vue d'ensemble de l'activité du CMPB</p>
      </div>

      <div className="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        <StatCard label="Total Visiteurs"       value={stats?.total_visitors ?? 0}      icon={Users}         color="bg-blue-500"    />
        <StatCard label="Total Rendez-vous"     value={stats?.total_appointments ?? 0}  icon={Calendar}      color="bg-primary-500" />
        <StatCard label="Rendez-vous en attente" value={stats?.pending_appointments ?? 0} icon={Clock}       color="bg-yellow-500"  sub="En attente de confirmation" />
        <StatCard label="Comptes Patients"      value={stats?.total_accounts ?? 0}      icon={UserCheck}     color="bg-purple-500"  />
        <StatCard label="Messages Reçus"        value={stats?.total_contacts ?? 0}      icon={MessageSquare} color="bg-indigo-500"  />
        <StatCard label="Messages non lus"      value={stats?.unread_contacts ?? 0}     icon={MessageSquare} color="bg-red-500"     sub="À traiter" />
      </div>
    </div>
  );
}
