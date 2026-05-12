import { NavLink, useNavigate } from "react-router-dom";
import {
  LayoutDashboard, Calendar, Users, MessageSquare,
  Stethoscope, ClipboardList, LogOut
} from "lucide-react";
import { clsx } from "clsx";
import { useAuth } from "../../hooks/useAuth";

const navItems = [
  { to: "/admin",            label: "Dashboard",      icon: LayoutDashboard, end: true },
  { to: "/admin/rendez-vous", label: "Rendez-vous",   icon: Calendar                   },
  { to: "/admin/visiteurs",   label: "Visiteurs",     icon: Users                      },
  { to: "/admin/contacts",    label: "Messages",      icon: MessageSquare              },
  { to: "/admin/services",    label: "Services",      icon: Stethoscope                },
  { to: "/admin/audit",       label: "Audit Logs",    icon: ClipboardList              },
];

export function AdminSidebar() {
  const { logout, user } = useAuth();
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate("/login");
  };

  return (
    <aside className="flex h-screen w-64 flex-col border-r bg-gray-900 text-white">
      {/* Brand */}
      <div className="px-6 py-5 border-b border-gray-700">
        <p className="text-xs font-semibold uppercase tracking-wider text-primary-400">Administration</p>
        <p className="font-bold text-white mt-0.5">CMPB</p>
      </div>

      {/* User */}
      <div className="px-6 py-4 border-b border-gray-700">
        <p className="text-xs text-gray-400">Connecté en tant que</p>
        <p className="text-sm font-medium text-white truncate">{user?.name}</p>
      </div>

      {/* Nav */}
      <nav className="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        {navItems.map(({ to, label, icon: Icon, end }) => (
          <NavLink
            key={to}
            to={to}
            end={end}
            className={({ isActive }) =>
              clsx(
                "flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors",
                isActive
                  ? "bg-primary-500 text-white"
                  : "text-gray-400 hover:bg-gray-800 hover:text-white"
              )
            }
          >
            <Icon className="h-5 w-5 flex-shrink-0" />
            {label}
          </NavLink>
        ))}
      </nav>

      {/* Logout */}
      <div className="px-3 py-4 border-t border-gray-700">
        <button
          onClick={handleLogout}
          className="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-400 hover:bg-gray-800 hover:text-white transition-colors"
        >
          <LogOut className="h-5 w-5" />
          Déconnexion
        </button>
      </div>
    </aside>
  );
}
