import { useState, useEffect, useCallback } from "react";
import { ChevronLeft, ChevronRight } from "lucide-react";
import { clsx } from "clsx";

interface Slide {
  type: "image" | "video";
  src: string;
  caption?: string;
  alt?: string;
  background?: string;
  description?: string;
}
// SLIDE ACCEUIL
const slides: Slide[] = [
  { type: "image", src: "/ASSETS/IMAGES/entree-principale.png", background: "/ASSETS/IMAGES/fondAcceuil.jpg", //Entrée principale du Centre Médical Protestant de Bafoussam                  
    caption: "Entrée principale",         alt: "Vue aérienne CMPB",      description: "Entrée principale du Centre Médical Protestant de Bafoussam"
  },
  { type: "image", src: "/ASSETS/IMAGES/Visiteembasadeur.jpg", background: "/ASSETS/IMAGES/fondAcceuil.jpg", // Visite de l'embasadeur de l'espagne au CMP Bafoussam          
    caption: "Entrée principale",           alt: "Entrée principale CMPB", description: "Visite de l'embasadeur de l'espagne du Cameroun au CMP Bafoussam"                
  },
  { type: "image", src: "/ASSETS/IMAGES/PofesseurRamos.jpg", background: "/ASSETS/IMAGES/fondAcceuil.jpg",  //Formation d'utilisation du BCPAP par le professeur RAMOS au CMP Bafoussam             
    caption: "Atelier de formation en néonatologie",    alt: "Atelier de formation", description: "Formation de la ventilisation non invasive par le professeur RAMOS au CMP Bafoussam"              
  },
  { type: "image", src: "/ASSETS/IMAGES/parcour.JPG", background: "/ASSETS/IMAGES/fondAcceuil.jpg",//Tourné d'evaluation a mis parcour du deuxieme vise presidant de EEC au CMP Bafoussam
    caption: "Salle d'acceuil",      alt: "Salle d'acceuille", description: "Tournée d'évaluation à mi-parcours du deuxième vice-président de l'EEC au CMP Bafoussam (2025)"                
  },
  { type: "image", src: "/ASSETS/IMAGES/CampagneSantePSYACHIATRIE.jpg", background: "/ASSETS/IMAGES/fondAcceuil.jpg", // Campagne de santer de PSYACHIATRIE par des Bénévole espagnole  (Fondation RECOVER)           
   caption: "Campagne de santé",     alt: "Campagne de santé", description: "Campagne de santé en psychiatrie par des bénévoles espagnols (Fondation RECOVER)"               },
  { type: "image", src: "/ASSETS/IMAGES/SETPR0011 (18).JPG", background: "/ASSETS/IMAGES/fondAcceuil.jpg",  //              
    caption: "Laboratoire",              alt: "Laboratoire", description: "Analyse des examens biochimiques"                   },
  { type: "image", src: "/ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg", background: "/ASSETS/IMAGES/fondAcceuil.jpg",  //      
    caption: "Bacteriologie",                  alt: "Bacteriologie", description: "Visite de Biologie sans fontière au laboratoire du CMP Bafoussam"                           
  },

];

interface HeroCarouselProps {
  onSlideChange?: (current: number, slide: Slide) => void;
}

export function HeroCarousel({ onSlideChange }: HeroCarouselProps) {
  const [current, setCurrent] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const [fits, setFits] = useState<string[]>(() => slides.map(() => "cover"));

  const prev = useCallback(() => setCurrent((c) => (c - 1 + slides.length) % slides.length), []);
  const next = useCallback(() => setCurrent((c) => (c + 1) % slides.length), []);

  useEffect(() => {
    if (isPaused) return;
    const t = setInterval(next, 5000);
    return () => clearInterval(t);
  }, [isPaused, next]);

  useEffect(() => {
    if (onSlideChange) {
      onSlideChange(current, slides[current]);
    }
  }, [current, onSlideChange]);

  return (
    <div
      className="relative h-[420px] sm:h-[520px] overflow-hidden bg-transparent"
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
    >
      {slides.map((slide, i) => (
        <div
          key={i}
          className={clsx(
            "absolute inset-0 transition-opacity duration-700",
            i === current ? "opacity-100" : "opacity-0 pointer-events-none"
          )}
        >
          {slide.background && (
            <img
              src={slide.background}
              alt="background"
              className="absolute inset-0 h-full w-full object-cover z-0"
            />
          )}
          <img
            src={slide.src}
            alt={slide.alt ?? ""}
            className={`absolute inset-0 h-full w-full ${fits[i] === "contain" ? "object-contain" : "object-cover"} object-center z-10`}
            onLoad={(e) => {
              try {
                const img = e.currentTarget as HTMLImageElement;
                const parent = img.parentElement as HTMLElement | null;
                if (!parent) return;
                const containerRatio = parent.clientWidth / parent.clientHeight || 1;
                const imageRatio = img.naturalWidth / img.naturalHeight || 1;
                setFits((p) => {
                  const next = p.slice();
                  next[i] = imageRatio < containerRatio ? "contain" : "cover";
                  return next;
                });
              } catch {}
            }}
            onError={(e) => {
              (e.target as HTMLImageElement).src = "/placeholder-hospital.jpg";
            }}
          />
          <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent z-20" />
          {slide.caption && (
            <div className="absolute bottom-12 left-0 right-0 text-center z-30">
              <span className="inline-block rounded-full bg-white/10 backdrop-blur-sm px-5 py-2 text-sm font-medium text-white border border-white/20">
                {slide.caption}
              </span>
            </div>
          )}
        </div>
      ))}

      {/* Controls */}
      <button
        onClick={prev}
        className="absolute left-4 top-1/2 -translate-y-1/2 flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-colors z-40"
        aria-label="Précédent"
      >
        <ChevronLeft className="h-6 w-6" />
      </button>
      <button
        onClick={next}
        className="absolute right-4 top-1/2 -translate-y-1/2 flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-colors z-40"
        aria-label="Suivant"
      >
        <ChevronRight className="h-6 w-6" />
      </button>

      {/* Dots */}
      <div className="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-40">
        {slides.map((_, i) => (
          <button
            key={i}
            onClick={() => setCurrent(i)}
            className={clsx(
              "h-2 rounded-full transition-all",
              i === current ? "w-6 bg-white" : "w-2 bg-white/50"
            )}
            aria-label={`Slide ${i + 1}`}
          />
        ))}
      </div>
    </div>
  );
}
