import { Link } from "react-router-dom";
import { Calendar, Phone, Heart, Shield, Clock, ChevronRight } from "lucide-react";
import { HeroCarousel } from "../components/HeroCarousel";
import { useServices } from "../hooks/useServices";
import { Button } from "../components/ui/Button";
import { LoadingSpinner } from "../components/ui/LoadingSpinner";

const stats = [
  { label: "Années d'expérience", value: "46+" },
  { label: "Services médicaux",   value: "13"  },
  { label: "Disponibilité",       value: "24/7"},
  { label: "Patients accompagnés",value: "∞"   },
];

const features = [
  {
    icon: Heart,
    title: "Soins de Qualité",
    desc: "Une équipe médicale compétente et dédiée à votre bien-être avec des équipements modernes.",
  },
  {
    icon: Shield,
    title: "Établissement Agréé",
    desc: "Centre agréé par le Ministère de la Santé du Cameroun depuis 1978.",
  },
  {
    icon: Clock,
    title: "Disponible 24h/24",
    desc: "Nos urgences et notre équipe restent disponibles 7 jours sur 7, 24 heures sur 24.",
  },
];

export default function Home() {
  const { data: services, isLoading } = useServices(true);

  return (
    <div>
      {/* Hero Carousel */}
      <div className="relative">
        <HeroCarousel />
        <div className="absolute inset-0 flex flex-col items-center justify-center text-center px-4 pointer-events-none">
          <h1 className="text-3xl sm:text-5xl font-extrabold text-white drop-shadow-lg mb-4 max-w-3xl leading-tight">
            Centre Médical Protestant<br />de Bafoussam
          </h1>
          <p className="text-white/90 text-lg max-w-xl mb-6 drop-shadow">
            Soins de qualité pour tous — au cœur de Bafoussam depuis 1978
          </p>
          <div className="flex flex-wrap gap-3 justify-center pointer-events-auto">
            <Link to="/rendez-vous">
              <Button size="lg">
                <Calendar className="h-5 w-5" />
                Prendre rendez-vous
              </Button>
            </Link>
            <Link to="/services">
              <Button size="lg" variant="outline" className="bg-white/10 border-white text-white hover:bg-white hover:text-primary-600">
                Nos services
              </Button>
            </Link>
          </div>
        </div>
      </div>

      {/* Stats */}
      <div className="bg-primary-500 text-white">
        <div className="mx-auto max-w-7xl px-4 py-8 grid grid-cols-2 lg:grid-cols-4 gap-6">
          {stats.map((s) => (
            <div key={s.label} className="text-center">
              <p className="text-3xl font-bold">{s.value}</p>
              <p className="text-sm text-primary-100 mt-1">{s.label}</p>
            </div>
          ))}
        </div>
      </div>

      {/* About section */}
      <section className="mx-auto max-w-7xl px-4 py-16">
        <div className="grid gap-12 lg:grid-cols-2 items-center">
          <div className="space-y-6">
            <div>
              <p className="text-sm font-semibold uppercase tracking-wider text-primary-500 mb-2">À propos du CMPB</p>
              <h2 className="text-3xl font-bold text-gray-900">Une institution de santé engagée</h2>
            </div>
            <p className="text-gray-600 leading-relaxed">
              Le Centre Médical Protestant de Bafoussam est une œuvre de témoignage de l'Église Évangélique du Cameroun (EEC). Créé en <strong>1978</strong> par arrêté d'ouverture N°135/A/MSP du 05/05/1978, il est situé en plein cœur de la ville de Bafoussam.
            </p>
            <p className="text-gray-600 leading-relaxed">
              Depuis sa médicalisation en l'an 2000, le CMPB est dirigé par des médecins qualifiés et propose une gamme complète de services médicaux accessibles à tous.
            </p>
            <div className="flex flex-col sm:flex-row gap-3">
              <Link to="/a-propos">
                <Button variant="outline">
                  En savoir plus <ChevronRight className="h-4 w-4" />
                </Button>
              </Link>
              <a href="tel:+237699573569">
                <Button variant="ghost">
                  <Phone className="h-4 w-4" />
                  Nous appeler
                </Button>
              </a>
            </div>
          </div>
          <div className="grid grid-cols-2 gap-4">
            <img
              src="/ASSETS/IMAGES/imgEnter.JPG"
              alt="Vue aérienne CMPB"
              className="rounded-2xl object-cover h-56 w-full shadow-card"
            />
            <img
              src="/ASSETS/IMAGES/entree-principale.png"
              alt="Entrée principale CMPB"
              className="rounded-2xl object-cover h-56 w-full shadow-card mt-8"
            />
            <img
              src="/ASSETS/IMAGES/SETPR0011 (25).JPG"
              alt="Équipements CMPB"
              className="rounded-2xl object-cover h-40 w-full shadow-card"
            />
            <img
              src="/ASSETS/IMAGES/consutation.jpg"
              alt="Consultation médicale"
              className="rounded-2xl object-cover h-40 w-full shadow-card mt-4"
            />
          </div>
        </div>
      </section>

      {/* Features */}
      <section className="bg-gray-50 py-16">
        <div className="mx-auto max-w-7xl px-4">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-gray-900">Pourquoi nous choisir ?</h2>
            <p className="text-gray-500 mt-3 max-w-xl mx-auto">
              Un établissement de confiance, des soins de qualité, une équipe dédiée.
            </p>
          </div>
          <div className="grid gap-8 sm:grid-cols-3">
            {features.map(({ icon: Icon, title, desc }) => (
              <div key={title} className="bg-white rounded-2xl p-6 shadow-card text-center">
                <div className="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary-50">
                  <Icon className="h-7 w-7 text-primary-500" />
                </div>
                <h3 className="font-semibold text-gray-900 mb-2">{title}</h3>
                <p className="text-sm text-gray-500 leading-relaxed">{desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Équipe & Dimension spirituelle */}
      <section className="mx-auto max-w-7xl px-4 py-16">
        <div className="text-center mb-10">
          <p className="text-sm font-semibold uppercase tracking-wider text-primary-500 mb-2">Notre équipe</p>
          <h2 className="text-3xl font-bold text-gray-900">Une médecine au service de l'homme</h2>
          <p className="text-gray-500 mt-3 max-w-2xl mx-auto">
            Le CMPB allie excellence médicale et engagement chrétien pour offrir des soins complets — du corps et de l'âme.
          </p>
        </div>
        <div className="grid gap-6 sm:grid-cols-2">
          <div className="group relative overflow-hidden rounded-2xl shadow-card">
            <img
              src="/ASSETS/IMAGES/equipe-medicale.jpeg"
              alt="Équipe médicale CMPB"
              className="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
            <div className="absolute bottom-0 left-0 right-0 p-5 text-white">
              <h3 className="font-bold text-lg">Équipe Médicale</h3>
              <p className="text-sm text-white/80">Des professionnels de santé qualifiés à votre service</p>
            </div>
          </div>
          <div className="group relative overflow-hidden rounded-2xl shadow-card">
            <img
              src="/ASSETS/IMAGES/pasteure.jpeg"
              alt="Dimension spirituelle CMPB"
              className="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
            <div className="absolute bottom-0 left-0 right-0 p-5 text-white">
              <h3 className="font-bold text-lg">Accompagnement Spirituel</h3>
              <p className="text-sm text-white/80">Une œuvre de témoignage de l'Église Évangélique du Cameroun</p>
            </div>
          </div>
        </div>
      </section>

      {/* Services preview */}
      <section className="mx-auto max-w-7xl px-4 py-16">
        <div className="flex items-center justify-between mb-10">
          <div>
            <p className="text-sm font-semibold uppercase tracking-wider text-primary-500 mb-1">Nos spécialités</p>
            <h2 className="text-3xl font-bold text-gray-900">Services Médicaux</h2>
          </div>
          <Link to="/services">
            <Button variant="outline" size="sm">
              Voir tous <ChevronRight className="h-4 w-4" />
            </Button>
          </Link>
        </div>

        {isLoading ? (
          <LoadingSpinner />
        ) : (
          <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            {services?.slice(0, 8).map((service) => (
              <div key={service.id} className="group flex items-center gap-3 rounded-xl border bg-white p-4 shadow-card hover:shadow-card-hover hover:border-primary-200 transition-all">
                <div className="h-10 w-10 flex-shrink-0 flex items-center justify-center rounded-full bg-primary-50 text-primary-500 group-hover:bg-primary-500 group-hover:text-white transition-colors">
                  <Heart className="h-5 w-5" />
                </div>
                <span className="text-sm font-medium text-gray-800">{service.name}</span>
              </div>
            ))}
          </div>
        )}
      </section>

      {/* CTA */}
      <section className="bg-primary-500 py-16 text-white text-center">
        <div className="mx-auto max-w-2xl px-4 space-y-6">
          <h2 className="text-3xl font-bold">Besoin d'une consultation ?</h2>
          <p className="text-primary-100">
            Notre équipe médicale est disponible 24h/24. Prenez rendez-vous en ligne ou appelez-nous directement.
          </p>
          <div className="flex flex-wrap gap-4 justify-center">
            <Link to="/rendez-vous">
              <Button size="lg" className="bg-white text-primary-600 hover:bg-primary-50">
                <Calendar className="h-5 w-5" />
                Prendre rendez-vous
              </Button>
            </Link>
            <a href="tel:+237699573569">
              <Button size="lg" variant="outline" className="border-white text-white hover:bg-primary-400">
                <Phone className="h-5 w-5" />
                +237 699 573 569
              </Button>
            </a>
          </div>
        </div>
      </section>
    </div>
  );
}
