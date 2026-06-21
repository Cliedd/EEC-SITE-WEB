import { useState } from "react";
import { Link, NavLink } from "react-router-dom";
import { Menu, X, Phone, Mail, Calendar } from "lucide-react";
import { clsx } from "clsx";
import { useAuth } from "../../hooks/useAuth";
import { Button } from "../ui/Button";

const navLinks = [
  { to: "/",            label: "Accueil"          },
  { to: "/a-propos",    label: "À Propos"          },
  { to: "/services",    label: "Services Médicaux" },
  { to: "/espace-patient", label: "Espace Patient" },
  { to: "/contact",     label: "Contact"           },
];

export function Header() {
  const [mobileOpen, setMobileOpen] = useState(false);
  const { isAuthenticated, isAdmin, user, logout } = useAuth();

  return (
    <header className="sticky top-0 z-50 bg-white shadow-sm">
      {/* Top bar */}
      <div className="bg-primary-500 text-white">
        <div className="mx-auto flex max-w-7xl items-center justify-between px-4 py-1.5 text-xs sm:text-sm">
          <div className="flex items-center gap-4">
            <a href="mailto:cmpbafoussam2020@gmail.com" className="flex items-center gap-1 hover:text-primary-100">
              <Mail className="h-3.5 w-3.5" />
              cmpbafoussam2020@gmail.com
            </a>
          </div>
          <div className="flex items-center gap-1">
            <Phone className="h-3.5 w-3.5" />
            <a href="tel:+237699573569" className="hover:text-primary-100">
               +237 93 03 67 12
            </a>
            <span className="mx-1 opacity-50">/</span>
            <a href="tel:+237654395887" className="hover:text-primary-100">
              +237 656239216
            </a>
          </div>
        </div>
      </div>

      {/* Main header */}
      <div className="mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
        {/* Logo */}
        <Link to="/" className="flex items-center gap-3">
          <img src="/LOGO_SITE.png" alt="CMPB" className="h-12 w-auto" onError={(e) => { (e.target as HTMLImageElement).style.display = "none"; }} />
          <div className="hidden sm:block">
            <p className="text-xs font-semibold uppercase tracking-wider text-primary-600">Centre médical protestant</p>
            <p className="text-lg font-bold text-gray-900 leading-tight">de Bafoussam</p>
          </div>
        </Link>

        {/* Desktop nav */}
        <nav className="hidden lg:flex items-center gap-1">
          {navLinks.map((l) => (
            <NavLink
              key={l.to}
              to={l.to}
              end={l.to === "/"}
              className={({ isActive }) =>
                clsx(
                  "px-3 py-2 rounded-lg text-sm font-medium transition-colors",
                  isActive
                    ? "bg-primary-50 text-primary-600"
                    : "text-gray-600 hover:bg-gray-100 hover:text-gray-900"
                )
              }
            >
              {l.label}
            </NavLink>
          ))}
        </nav>

        {/* Actions */}
        <div className="hidden lg:flex items-center gap-2">
          <Link to="/rendez-vous">
            <Button size="sm" variant="primary">
              <Calendar className="h-4 w-4" />
              Rendez-vous
            </Button>
          </Link>
          {isAuthenticated ? (
            <div className="flex items-center gap-2">
              {isAdmin && (
                <Link to="/admin">
                  <Button size="sm" variant="outline">Dashboard</Button>
                </Link>
              )}
              <span className="text-sm text-gray-600 hidden xl:block">{user?.name}</span>
              <Button size="sm" variant="ghost" onClick={logout}>Déconnexion</Button>
            </div>
          ) : (
            <>
              <Link to="/login"><Button size="sm" variant="ghost">Connexion</Button></Link>
              <Link to="/inscription"><Button size="sm" variant="outline">Inscription</Button></Link>
            </>
          )}
        </div>

        {/* Mobile menu toggle */}
        <button
          className="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100"
          onClick={() => setMobileOpen((v) => !v)}
          aria-label="Menu"
        >
          {mobileOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
        </button>
      </div>

      {/* Mobile menu */}
      {mobileOpen && (
        <div className="lg:hidden border-t bg-white px-4 py-3 space-y-1">
          {navLinks.map((l) => (
            <NavLink
              key={l.to}
              to={l.to}
              end={l.to === "/"}
              onClick={() => setMobileOpen(false)}
              className={({ isActive }) =>
                clsx(
                  "block px-3 py-2 rounded-lg text-sm font-medium",
                  isActive ? "bg-primary-50 text-primary-600" : "text-gray-600 hover:bg-gray-100"
                )
              }
            >
              {l.label}
            </NavLink>
          ))}
          <div className="pt-3 border-t flex flex-col gap-2">
            <Link to="/rendez-vous" onClick={() => setMobileOpen(false)}>
              <Button size="sm" className="w-full">Prendre rendez-vous</Button>
            </Link>
            {isAuthenticated ? (
              <Button size="sm" variant="ghost" onClick={() => { logout(); setMobileOpen(false); }}>
                Déconnexion
              </Button>
            ) : (
              <>
                <Link to="/login" onClick={() => setMobileOpen(false)}>
                  <Button size="sm" variant="ghost" className="w-full">Connexion</Button>
                </Link>
                <Link to="/inscription" onClick={() => setMobileOpen(false)}>
                  <Button size="sm" variant="outline" className="w-full">Inscription</Button>
                </Link>
              </>
            )}
          </div>
        </div>
      )}
    </header>
  );
}
