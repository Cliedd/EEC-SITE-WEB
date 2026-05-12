import { clsx } from "clsx";
import { CheckCircle, AlertCircle, Info, XCircle } from "lucide-react";

type AlertType = "success" | "error" | "info" | "warning";

const config: Record<AlertType, { bg: string; text: string; icon: React.FC<{ className?: string }> }> = {
  success: { bg: "bg-green-50 border-green-200", text: "text-green-800", icon: CheckCircle },
  error:   { bg: "bg-red-50 border-red-200",     text: "text-red-800",   icon: XCircle    },
  info:    { bg: "bg-blue-50 border-blue-200",    text: "text-blue-800",  icon: Info       },
  warning: { bg: "bg-yellow-50 border-yellow-200", text: "text-yellow-800", icon: AlertCircle },
};

export function Alert({
  type = "info",
  message,
  className,
}: {
  type?: AlertType;
  message: string;
  className?: string;
}) {
  const { bg, text, icon: Icon } = config[type];
  return (
    <div className={clsx("flex items-start gap-3 rounded-lg border p-4", bg, className)}>
      <Icon className={clsx("h-5 w-5 flex-shrink-0 mt-0.5", text)} />
      <p className={clsx("text-sm font-medium", text)}>{message}</p>
    </div>
  );
}
