import { useState, useEffect, useCallback } from "react";
import { ChevronLeft, ChevronRight } from "lucide-react";
import { clsx } from "clsx";

interface Slide {
  type: "image" | "video";
  src: string;
  caption?: string;
  alt?: string;
}

const slides: Slide[] = [
  { type: "image", src: "/ASSETS/IMAGES/imgEnter.JPG",                      caption: "Notre établissement",         alt: "Vue aérienne CMPB"                     },
  { type: "image", src: "/ASSETS/IMAGES/entree-principale.png",             caption: "Entrée principale",           alt: "Entrée principale CMPB"                },
  { type: "image", src: "/ASSETS/IMAGES/SETPR0011 (187).JPG",               caption: "Service de Bactériologie",    alt: "Équipement bactériologie"              },
  { type: "image", src: "/ASSETS/IMAGES/SETPR0011 (70).JPG",                caption: "Service de Réanimation",      alt: "Équipement réanimation"                },
  { type: "image", src: "/ASSETS/IMAGES/SETPR0011 (125).JPG",               caption: "Service de Néonatologie",     alt: "Équipement néonatologie"               },
  { type: "image", src: "/ASSETS/IMAGES/SETPR0011 (18).JPG",                caption: "Salle de soins",              alt: "Salle de soins CMPB"                   },
  { type: "image", src: "/ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg",        caption: "Nos locaux",                  alt: "Locaux CMPB"                           },
  { type: "image", src: "/ASSETS/IMAGES/consutation.jpg",                   caption: "Consultations médicales",     alt: "Consultation médicale"                 },
];

export function HeroCarousel() {
  const [current, setCurrent] = useState(0);
  const [isPaused, setIsPaused] = useState(false);

  const prev = useCallback(() => setCurrent((c) => (c - 1 + slides.length) % slides.length), []);
  const next = useCallback(() => setCurrent((c) => (c + 1) % slides.length), []);

  useEffect(() => {
    if (isPaused) return;
    const t = setInterval(next, 5000);
    return () => clearInterval(t);
  }, [isPaused, next]);

  return (
    <div
      className="relative h-[420px] sm:h-[520px] overflow-hidden bg-gray-900"
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
          <img
            src={slide.src}
            alt={slide.alt ?? ""}
            className="h-full w-full object-cover"
            onError={(e) => {
              (e.target as HTMLImageElement).src = "/placeholder-hospital.jpg";
            }}
          />
          <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent" />
          {slide.caption && (
            <div className="absolute bottom-12 left-0 right-0 text-center">
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
        className="absolute left-4 top-1/2 -translate-y-1/2 flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-colors"
        aria-label="Précédent"
      >
        <ChevronLeft className="h-6 w-6" />
      </button>
      <button
        onClick={next}
        className="absolute right-4 top-1/2 -translate-y-1/2 flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-colors"
        aria-label="Suivant"
      >
        <ChevronRight className="h-6 w-6" />
      </button>

      {/* Dots */}
      <div className="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
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
