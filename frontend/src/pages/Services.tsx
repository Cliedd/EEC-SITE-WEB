import { AlertTriangle } from "lucide-react";


export default function Services() {
  return (
    <div>
      {/* Hero */}
      <div
        className="relative h-64 flex items-center justify-center bg-cover bg-center bg-fixed"
        style={{ backgroundImage: "url('/ASSETS/IMAGES/sevices.jpg')" }}
      >
        <div className="absolute inset-0 bg-gray-900/60" />
        <div className="relative text-center text-white px-4">
          <h1 className="text-4xl font-extrabold">Services Médicaux</h1>
          <p className="mt-2 text-white/80 max-w-lg mx-auto">
            Des soins complets et spécialisés pour répondre à tous vos besoins de santé
          </p>
        </div>
      </div>

      <div className="mx-auto max-w-6xl px-4 py-16">
        <div className="rounded-2xl bg-gray-100 p-6 mb-12">
          <div className="text-center mb-6">
            <h2 className="text-2xl sm:text-3xl font-bold text-gray-900">Nos Spécialités</h2>
            <p className="text-gray-600 mt-2 max-w-2xl mx-auto text-sm sm:text-base">
              Le Centre Médical Protestant de Bafoussam met à votre disposition une gamme complète de services médicaux.
            </p>
          </div>
          <div className="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            {[
              "Médecine interne",
              "Maternité",
              "Pédiatrie/Neonatalogie",
              "Chirurgie",
              "Urgences",
              "Imagerie médicale",
              "Soins intensifs",
              "Neurologie",
              "Laboratoire",
              "Nutrition",
              "Kinesitherapeute",
              "Pharmacie",
              "Vaccination",
              "UPEC",
              "Administration",
              "Aumonerie",
            ].map((service) => (
              <div key={service} className="rounded-2xl bg-white px-4 py-5 text-center shadow-sm">
                <div className="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                  <span className="text-base font-bold">✓</span>
                </div>
                <p className="text-sm font-medium text-gray-900">{service}</p>
              </div>
            ))}
          </div>
        </div>

        {/* Equipment gallery */}
        <div className="mt-16">
          <h2 className="text-2xl font-bold text-gray-900 mb-2 text-center">Nos Équipements</h2>
          <p className="text-gray-500 text-center mb-8">Un plateau technique moderne pour des soins de qualité</p>
          <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            {[
              { src: "/ASSETS/listte_appariels/Microscope.jpg",                    label: "Microscope"                  },
              { src: "/ASSETS/listte_appariels/Dialyseur.jpg",                     label: "Dialyseur"                   },
              { src: "/ASSETS/listte_appariels/Contracteur oxygene.jpg",           label: "Concentrateur d'oxygène"     },
              { src: "/ASSETS/listte_appariels/Appariels electrostimulation.jpg",  label: "Électrostimulation"          },
              { src: "/ASSETS/listte_appariels/Appariel endodontique.jpg",         label: "Appareil endodontique"       },
            ].map(({ src, label }) => (
              <div key={label} className="group rounded-xl overflow-hidden shadow-card border bg-white">
                <div className="aspect-square overflow-hidden">
                  <img
                    src={src}
                    alt={label}
                    className="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300"
                  />
                </div>
                <p className="text-xs font-medium text-gray-600 text-center py-2 px-1">{label}</p>
              </div>
            ))}
          </div>
        </div>

        {/* Emergency banner */}
        <div className="mt-16 rounded-2xl bg-secondary-500 p-8 text-white text-center">
          <AlertTriangle className="h-10 w-10 mx-auto mb-3 opacity-80" />
          <h3 className="text-2xl font-bold mb-2">Urgences Médicales</h3>
          <p className="text-red-100 mb-5">
            Notre unité d'urgences est disponible 24h/24, 7j/7 pour tous cas critiques.
          </p>
          <a
            href="tel:+237699573569"
            className="inline-flex items-center gap-2 bg-white text-red-600 font-bold px-6 py-3 rounded-lg hover:bg-red-50 transition-colors"
          >
            Appeler le  +237 93 03 67 12
          </a>
        </div>
      </div>
    </div>
  );
}
