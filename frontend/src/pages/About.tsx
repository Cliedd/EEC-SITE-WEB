const team = [
  {
    name: "Dr Bonny Dalle Mouanjo Cyrille",
    role: "Médecin-chef",
    img: "/ASSETS/IMAGES/MedecinChef.jpg",
  },
  {
    name: "Douanla Nadège",
    role: "Surveillante générale",
    img: "/ASSETS/IMAGES/SuveillanteGenerale.jpg",
  },
  {
    name: "Mouelle Dika Richard",
    role: "Responsable Financier",
    img: "/ASSETS/IMAGES/responsable-financier.jpg",
  },
  
  {
    name: "Nzeket Njankouo Caroline Epouse Mfoutie",
    role: "Aumonière",
    img: "/ASSETS/IMAGES/pasteure.jpeg",
  },
];

export default function About() {
  const directors = [
    { period: "1978 – 1994", name: "M. Njeunguo Paul"      },
    { period: "1994 – 1997", name: "M. Njeutang Benjamin"  },
    { period: "1997 – 2000", name: "M. Kamdem Samuel"      },
    { period: "2000 – 2010", name: "Dr Nana Martial"       },
    { period: "2010 – 2013", name: "Dr Ndensi Jean Paul"   },
    { period: "2013 – 2014", name: "Dr Tchamou Michel"     },
    { period: "2014 – 2020", name: "Dr Chemgne Nadine"     },
    { period: "2020 – Auj.", name: "Dr Bonny Dalle Mouanjo Cyrille" },
  ];

  return (
    <div>
      {/* Hero */}
      <div
        className="relative h-64 flex items-center justify-center bg-cover bg-center"
        style={{ backgroundImage: "url('/ASSETS/IMAGES/IMG-service3.jpg')" }}
      >
        <div className="absolute inset-0 bg-primary-900/70" />
        <div className="relative text-center text-white px-4">
          <h1 className="text-4xl font-extrabold">À Propos du CMPB</h1>
          <p className="mt-2 text-primary-200">Notre histoire, notre mission, nos valeurs</p>
        </div>
      </div>

      <div className="mx-auto max-w-7xl px-4 py-16 space-y-16">
        {/* About text */}
        <section className="grid gap-10 lg:grid-cols-2 items-start">
          <div className="space-y-5 text-gray-600 leading-relaxed">
            <h2 className="text-2xl font-bold text-gray-900">Notre Histoire</h2>
            <p>
              Le Centre Médical Protestant de Bafoussam est une œuvre de témoignage de l'Église Évangélique du Cameroun (EEC). C'est un centre de formation sanitaire créé en <strong>1978</strong> par arrêté d'ouverture <em>N°135/A/MSP du 05/05/1978</em>, situé en plein cœur de la ville de Bafoussam au lieu-dit plateau après le marché C.
            </p>
            <p>
              À son ouverture, le CMPB était appelé « Centre de Santé Médicalisé de Bafoussam » et était intégré à l'Hôpital Protestant de Mbouo-Bandjoun, d'où l'alias « Petit Mbouo ».
            </p>
            <p>
              Dès sa création jusqu'en l'an 2000, ce centre était dirigé par des infirmiers. À partir de 2000, date de sa médicalisation, il a été confié à des médecins portant le titre de « Médecin-chef ».
            </p>
          </div>
          <div className="bg-gray-50 rounded-2xl p-6">
            <h3 className="text-lg font-bold text-gray-900 mb-5">Historique des Responsables</h3>
            <ul className="space-y-3">
              {directors.map((d) => (
                <li key={d.period} className="flex items-center gap-4">
                  <span className="text-xs font-semibold text-primary-600 bg-primary-50 rounded-full px-3 py-1 whitespace-nowrap">
                    {d.period}
                  </span>
                  <span className="text-sm text-gray-700">{d.name}</span>
                </li>
              ))}
            </ul>
          </div>
        </section>

        {/* Team photos */}
        <section>
          <h2 className="text-2xl font-bold text-gray-900 mb-8 text-center">Notre Direction</h2>
          <div className="flex flex-wrap justify-center gap-8">
            {team.map(({ name, role, img }) => (
              <div key={name} className="text-center space-y-3">
                <div className="mx-auto h-40 w-40 overflow-hidden rounded-full border-4 border-primary-100 shadow-card">
                  <img
                    src={img}
                    alt={name}
                    className="h-full w-full object-cover object-top"
                    onError={(e) => { (e.target as HTMLImageElement).style.display = "none"; }}
                  />
                </div>
                <div>
                  <p className="font-semibold text-gray-900">{name}</p>
                  <p className="text-sm text-primary-600">{role}</p>
                </div>
              </div>
            ))}
          </div>
        </section>

        {/* Gallery */}
        <section>
          <h2 className="text-2xl font-bold text-gray-900 mb-6 text-center">Nos Locaux</h2>
          <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            {[
              { src: "/ASSETS/IMAGES/entree-principale.png",     alt: "Entrée principale"      },
              { src: "/ASSETS/IMAGES/imgEnter.JPG",              alt: "Vue aérienne"            },
              { src: "/ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg", alt: "Bâtiment CMPB"         },
              { src: "/ASSETS/IMAGES/IMG-20251011-WA0006(1).jpg", alt: "Installations"          },
              { src: "/ASSETS/IMAGES/SETPR0011 (18).JPG",         alt: "Salle de soins"        },
              { src: "/ASSETS/IMAGES/SETPR0011 (25).JPG",         alt: "Équipements médicaux"  },
              { src: "/ASSETS/IMAGES/IMG-service1.jpg",           alt: "Service médical"        },
              { src: "/ASSETS/IMAGES/consutation.jpg",            alt: "Salle de consultation" },
            ].map(({ src, alt }) => (
              <div key={src} className="aspect-square overflow-hidden rounded-xl shadow-card">
                <img
                  src={src}
                  alt={alt}
                  className="h-full w-full object-cover hover:scale-105 transition-transform duration-300"
                  onError={(e) => { (e.target as HTMLImageElement).parentElement!.style.display = "none"; }}
                />
              </div>
            ))}
          </div>
        </section>

        {/* Mission & Vision */}
        <section className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {[
            { title: "Notre Mission", text: "Offrir des soins médicaux de qualité accessibles à toute la population de Bafoussam et des régions environnantes, dans la crainte de Dieu." },
            { title: "Notre Vision",  text: "Devenir un centre médical de référence dans la région de l'Ouest Cameroun, alliant excellence médicale, accessibilité financière et humanisme." },
            { title: "Nos Valeurs",  text: "Intégrité, compassion, excellence professionnelle, respect de la dignité humaine et engagement communautaire guident chacune de nos actions." },
          ].map(({ title, text }) => (
            <div key={title} className="rounded-2xl border border-primary-100 p-6 bg-white shadow-card">
              <div className="h-1 w-10 bg-primary-500 rounded mb-4" />
              <h3 className="font-bold text-gray-900 mb-3">{title}</h3>
              <p className="text-sm text-gray-600 leading-relaxed">{text}</p>
            </div>
          ))}
        </section>
      </div>
    </div>
  );
}
