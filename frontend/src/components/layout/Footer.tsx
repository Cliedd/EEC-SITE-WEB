import { Link } from "react-router-dom";
import { Phone, Mail, Clock, MapPin, Facebook, Youtube, Linkedin } from "lucide-react";

export function Footer() {
  return (
    <footer className="bg-gray-900 text-gray-300">
      <div className="mx-auto max-w-7xl px-4 py-12">
        <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
          {/* Brand */}
          <div className="space-y-4">
            <div>
              <p className="text-xs font-semibold uppercase tracking-wider text-primary-400">Centre médical protestant</p>
              <p className="text-xl font-bold text-white">de Bafoussam</p>
            </div>
            <p className="text-sm leading-relaxed">
              Œuvre de témoignage de l'Église Évangélique du Cameroun, au service de la santé depuis 1978.
            </p>
            <div className="flex gap-3">
              {[
                { icon: Facebook, href: "#", label: "Facebook" },
                { icon: Youtube,  href: "#", label: "YouTube"  },
                { icon: Linkedin, href: "#", label: "LinkedIn" },
              ].map(({ icon: Icon, href, label }) => (
                <a
                  key={label}
                  href={href}
                  aria-label={label}
                  className="flex h-9 w-9 items-center justify-center rounded-full bg-gray-800 text-gray-400 transition-colors hover:bg-primary-500 hover:text-white"
                >
                  <Icon className="h-4 w-4" />
                </a>
              ))}
            </div>
          </div>

          {/* Services */}
          <div>
            <h3 className="mb-4 text-sm font-semibold uppercase tracking-wider text-white">Nos Services</h3>
            <ul className="space-y-2 text-sm">
              {["Consultations", "Hospitalisation", "Urgences 24h/24", "Pédiatrie", "Gynécologie", "Chirurgie"].map((s) => (
                <li key={s}>
                  <Link to="/services" className="hover:text-primary-400 transition-colors">
                    {s}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Liens rapides */}
          <div>
            <h3 className="mb-4 text-sm font-semibold uppercase tracking-wider text-white">Liens Rapides</h3>
            <ul className="space-y-2 text-sm">
              {[
                { to: "/a-propos",       label: "À Propos"           },
                { to: "/espace-patient", label: "Espace Patient"     },
                { to: "/rendez-vous",    label: "Prendre Rendez-vous"},
                { to: "/contact",        label: "Contact"            },
                { to: "/inscription",    label: "Créer un compte"    },
              ].map(({ to, label }) => (
                <li key={to}>
                  <Link to={to} className="hover:text-primary-400 transition-colors">{label}</Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact */}
          <div>
            <h3 className="mb-4 text-sm font-semibold uppercase tracking-wider text-white">Contact</h3>
            <ul className="space-y-3 text-sm">
              <li className="flex items-start gap-2">
                <MapPin className="h-4 w-4 text-primary-400 mt-0.5 flex-shrink-0" />
                <span>Avant le stade omnisports Kouekong, Bafoussam</span>
              </li>
              <li className="flex items-center gap-2">
                <Phone className="h-4 w-4 text-primary-400 flex-shrink-0" />
                <a href="tel:+237699573569" className="hover:text-primary-400">+237 699 573 569</a>
              </li>
              <li className="flex items-center gap-2">
                <Mail className="h-4 w-4 text-primary-400 flex-shrink-0" />
                <a href="mailto:cmpbafoussam2020@gmail.com" className="hover:text-primary-400 break-all">
                  cmpbafoussam2020@gmail.com
                </a>
              </li>
              <li className="flex items-center gap-2">
                <Clock className="h-4 w-4 text-primary-400 flex-shrink-0" />
                <span>24h/24 — 7j/7</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div className="border-t border-gray-800">
        <div className="mx-auto max-w-7xl px-4 py-4 text-center text-xs text-gray-500">
          © {new Date().getFullYear()} Centre Médical Protestant de Bafoussam. Tous droits réservés.
        </div>
      </div>
    </footer>
  );
}
