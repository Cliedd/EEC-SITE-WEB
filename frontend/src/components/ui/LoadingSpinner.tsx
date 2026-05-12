import { clsx } from "clsx";

export function LoadingSpinner({ className }: { className?: string }) {
  return (
    <div className={clsx("flex items-center justify-center py-12", className)}>
      <div className="h-10 w-10 animate-spin rounded-full border-4 border-primary-200 border-t-primary-500" />
    </div>
  );
}

export function PageLoader() {
  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center bg-white/80 backdrop-blur-sm">
      <div className="flex flex-col items-center gap-4">
        <div className="h-12 w-12 animate-spin rounded-full border-4 border-primary-200 border-t-primary-500" />
        <p className="text-sm text-gray-500">Chargement…</p>
      </div>
    </div>
  );
}
