import { clsx } from "clsx";

type BadgeVariant = "green" | "yellow" | "red" | "blue" | "gray";

const variants: Record<BadgeVariant, string> = {
  green: "bg-green-100 text-green-800",
  yellow: "bg-yellow-100 text-yellow-800",
  red: "bg-red-100 text-red-800",
  blue: "bg-blue-100 text-blue-800",
  gray: "bg-gray-100 text-gray-700",
};

export function Badge({
  variant = "gray",
  children,
  className,
}: {
  variant?: BadgeVariant;
  children: React.ReactNode;
  className?: string;
}) {
  return (
    <span
      className={clsx(
        "inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium",
        variants[variant],
        className
      )}
    >
      {children}
    </span>
  );
}

export function statusBadge(status: string) {
  const map: Record<string, { label: string; variant: BadgeVariant }> = {
    pending:   { label: "En attente",  variant: "yellow" },
    confirmed: { label: "Confirmé",    variant: "green"  },
    cancelled: { label: "Annulé",      variant: "red"    },
    completed: { label: "Terminé",     variant: "blue"   },
    unread:    { label: "Non lu",      variant: "yellow" },
    read:      { label: "Lu",          variant: "blue"   },
    replied:   { label: "Répondu",     variant: "green"  },
    success:   { label: "Succès",      variant: "green"  },
    failure:   { label: "Échec",       variant: "red"    },
  };
  const s = map[status] ?? { label: status, variant: "gray" as BadgeVariant };
  return <Badge variant={s.variant}>{s.label}</Badge>;
}
