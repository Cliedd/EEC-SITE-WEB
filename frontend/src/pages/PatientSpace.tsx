import { Link } from "react-router-dom";
import { Calendar, FileText, Phone, CheckCircle } from "lucide-react";
import { Button } from "../components/ui/Button";

const gallery = [
  { src: "/ASSETS/IMAGES/SETPR0011 (125).JPG",               alt: "Néonatologie"          },
  { src: "/ASSETS/IMAGES/SETPR0011 (187).JPG",               alt: "Bactériologie"         },
  { src: "/ASSETS/IMAGES/SETPR0011 (70).JPG",                alt: "Réanimation"           },
  { src: "/ASSETS/IMAGES/SETPR0011 (27).JPG",                alt: "Équipement médical"    },
  { src: "/ASSETS/IMAGES/IMG-service1.jpg",                  alt: "Service médical"       },
  { src: "/ASSETS/IMAGES/IMG-service2.jpg",                  alt: "Salle de soins"        },
  { src: "/ASSETS/IMAGES/IMG-service3.jpg",                  alt: "Consultation"          },
  { src: "/ASSETS/IMAGES/IMG-service4.jpg",                  alt: "Plateau technique"     },
  { src: "/ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg",        alt: "Nos installations"     },
  { src: "/ASSETS/IMAGES/IMG-20251011-WA0006(1).jpg",        alt: "Locaux CMPB"           },
];

const steps = [
  { icon: Calendar,    title: "Prendre rendez-vous",    desc: "En ligne, par téléphone ou en vous présentant directement au centre."  },
  { icon: FileText,    title: "Préparer vos documents", desc: "Munissez-vous de votre carnet de santé, ordonnances et résultats antérieurs." },
  { icon: CheckCircle, title: "Consultation",           desc: "Notre équipe médicale vous accueille et prend en charge votre dossier."  },
];

export default function PatientSpace() {
  return (
    <div>
      {/* Hero */}
      <div
        className="relative h-72 flex items-center justify-center bg-cover bg-center bg-fixed"
        style={{ backgroundImage: "url('/ASSETS/IMAGES/IMG-service1.jpg')" }}
      >
        <div className="absolute inset-0 bg-primary-900/65" />
        <div className="relative text-center text-white px-4">
          <h1 className="text-4xl font-extrabold">Espace Patient</h1>
          <p className="mt-2 text-primary-200 max-w-xl mx-auto">
            Tout ce que vous devez savoir pour préparer votre visite au Centre Médical Protestant de Bafoussam
          </p>
          <div className="mt-6">
            <Link to="/rendez-vous">
              <Button size="lg" className="bg-white text-primary-600 hover:bg-primary-50">
                <Calendar className="h-5 w-5" />
                Prendre rendez-vous
              </Button>
            </Link>
          </div>
        </div>
      </div>

      <div className="mx-auto max-w-7xl px-4 py-16 space-y-16">
        {/* Steps */}
        <section>
          <h2 className="text-2xl font-bold text-gray-900 mb-8 text-center">Comment se déroule votre visite ?</h2>
          <div className="grid gap-6 sm:grid-cols-3">
            {steps.map(({ icon: Icon, title, desc }, i) => (
              <div key={title} className="relative bg-white rounded-2xl border shadow-card p-6">
                <div className="absolute -top-4 left-6 h-8 w-8 flex items-center justify-center rounded-full bg-primary-500 text-white text-sm font-bold">
                  {i + 1}
                </div>
                <div className="mt-4 mb-3">
                  <Icon className="h-7 w-7 text-primary-500" />
                </div>
                <h3 className="font-semibold text-gray-900 mb-2">{title}</h3>
                <p className="text-sm text-gray-500 leading-relaxed">{desc}</p>
              </div>
            ))}
          </div>
        </section>

        {/* Info cards */}
        <section className="grid gap-6 sm:grid-cols-2">
          <div className="rounded-2xl bg-primary-50 border border-primary-100 p-6 space-y-3">
            <h3 className="font-bold text-primary-800 text-lg">Horaires d'ouverture</h3>
            <p className="text-primary-700">Le CMPB est ouvert <strong>24h/24, 7j/7</strong>.</p>
            <p className="text-sm text-primary-600">
              Les urgences sont disponibles à toute heure. Les consultations de routine ont lieu en journée.
            </p>
          </div>
          <div className="rounded-2xl bg-gray-50 border p-6 space-y-3">
            <h3 className="font-bold text-gray-900 text-lg">Documents à apporter</h3>
            <ul className="text-sm text-gray-600 space-y-2">
              {["Pièce d'identité (si disponible)", "Carnet de santé (si disponible)", "Ordonnances et résultats d'examens antérieurs", "Carte d'assurance maladie (si applicable)"].map((d) => (
                <li key={d} className="flex items-start gap-2">
                  <CheckCircle className="h-4 w-4 text-primary-500 flex-shrink-0 mt-0.5" />
                  {d}
                </li>
              ))}
            </ul>
          </div>
        </section>

        {/* Gallery */}
        <section>
          <h2 className="text-2xl font-bold text-gray-900 mb-6 text-center">Nos Installations</h2>
          <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
            {gallery.map(({ src, alt }) => (
              <div key={src} className="aspect-square overflow-hidden rounded-xl">
                <img
                  src={src}
                  alt={alt}
                  className="h-full w-full object-cover hover:scale-105 transition-transform duration-300"
                />
              </div>
            ))}
          </div>
        </section>

        {/* Contact urgences */}
        <section className="rounded-2xl bg-gray-900 text-white p-8 text-center space-y-4">
          <Phone className="h-10 w-10 mx-auto text-primary-400" />
          <h3 className="text-2xl font-bold">Ligne d'urgence</h3>
          <p className="text-gray-400">En cas d'urgence médicale, appelez-nous immédiatement</p>
          <div className="flex flex-wrap gap-3 justify-center">
            <a href="tel:+237699573569" className="inline-block bg-primary-500 hover:bg-primary-600 text-white font-bold px-6 py-3 rounded-lg transition-colors">
              +237 693 03 67 12
            </a>
            <a href="tel:+237654395887" className="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold px-6 py-3 rounded-lg transition-colors">
              +237 656 23 92 16
            </a>
          </div>
        </section>
      </div>
    </div>
  );
}
