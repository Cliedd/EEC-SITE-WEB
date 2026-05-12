import { useState } from "react";
import { useForm } from "react-hook-form";
import { Calendar, CheckCircle } from "lucide-react";
import { Input } from "../components/ui/Input";
import { Button } from "../components/ui/Button";
import { Alert } from "../components/ui/Alert";
import { useCreateAppointment } from "../hooks/useAppointments";
import { useServices } from "../hooks/useServices";
import type { AppointmentCreate } from "../types";

export default function Appointment() {
  const [success, setSuccess] = useState(false);
  const { data: services } = useServices(true);
  const { mutateAsync: createAppt, isPending, error } = useCreateAppointment();

  const {
    register,
    handleSubmit,
    reset,
    formState: { errors },
  } = useForm<AppointmentCreate>();

  const onSubmit = async (data: AppointmentCreate) => {
    await createAppt(data);
    setSuccess(true);
    reset();
  };

  if (success) {
    return (
      <div className="min-h-[60vh] flex items-center justify-center px-4">
        <div className="max-w-md w-full text-center space-y-6 bg-white rounded-2xl shadow-card p-10 border">
          <div className="flex justify-center">
            <div className="h-20 w-20 flex items-center justify-center rounded-full bg-green-100">
              <CheckCircle className="h-10 w-10 text-green-600" />
            </div>
          </div>
          <h2 className="text-2xl font-bold text-gray-900">Demande envoyée !</h2>
          <p className="text-gray-500">
            Votre demande de rendez-vous a bien été reçue. Notre équipe vous contactera pour confirmation.
          </p>
          <div className="bg-gray-50 rounded-xl p-4 text-sm text-left space-y-2">
            <p className="font-semibold text-gray-700">Contacts d'urgence :</p>
            <p><a href="tel:+237699573569" className="text-primary-600 font-medium">+237 699 573 569</a></p>
            <p><a href="tel:+237654395887" className="text-primary-600 font-medium">+237 654 395 887</a></p>
          </div>
          <Button onClick={() => setSuccess(false)} variant="outline" className="w-full">
            Prendre un autre rendez-vous
          </Button>
        </div>
      </div>
    );
  }

  return (
    <div>
      {/* Hero */}
      <div
        className="relative h-56 flex items-center justify-center bg-cover bg-center"
        style={{ backgroundImage: "url('/ASSETS/IMAGES/SETPR0011 (27).JPG')" }}
      >
        <div className="absolute inset-0 bg-gray-900/65" />
        <div className="relative text-center text-white px-4">
          <h1 className="text-4xl font-extrabold">Prendre Rendez-vous</h1>
          <p className="mt-2 text-white/80">Remplissez le formulaire ci-dessous — nous vous confirmerons rapidement</p>
        </div>
      </div>

      <div className="mx-auto max-w-2xl px-4 py-14">
        <div className="bg-white rounded-2xl shadow-card border p-8">
          <div className="flex items-center gap-3 mb-8">
            <div className="h-10 w-10 flex items-center justify-center rounded-full bg-primary-50">
              <Calendar className="h-5 w-5 text-primary-500" />
            </div>
            <h2 className="text-xl font-bold text-gray-900">Formulaire de rendez-vous</h2>
          </div>

          {error && (
            <Alert
              type="error"
              message={(error as { response?: { data?: { detail?: string } } })?.response?.data?.detail ?? "Une erreur est survenue. Veuillez réessayer."}
              className="mb-6"
            />
          )}

          <form onSubmit={handleSubmit(onSubmit)} noValidate className="space-y-5">
            <div className="grid gap-5 sm:grid-cols-2">
              <Input
                label="Nom et Prénom"
                placeholder="Votre nom complet"
                required
                error={errors.name_surName?.message}
                {...register("name_surName", { required: "Le nom est obligatoire", minLength: { value: 3, message: "Minimum 3 caractères" } })}
              />
              <Input
                label="Email"
                type="email"
                placeholder="exemple@email.com"
                required
                error={errors.email?.message}
                {...register("email", { required: "L'email est obligatoire", pattern: { value: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, message: "Email invalide" } })}
              />
            </div>

            <div className="grid gap-5 sm:grid-cols-2">
              <Input
                label="Téléphone"
                type="tel"
                placeholder="+237 XXX XXX XXX"
                required
                error={errors.telephone?.message}
                {...register("telephone", { required: "Le téléphone est obligatoire" })}
              />
              <Input
                label="Date et heure souhaitées"
                type="datetime-local"
                required
                error={errors.date_appointment?.message}
                {...register("date_appointment", { required: "La date est obligatoire" })}
              />
            </div>

            <div className="flex flex-col gap-1">
              <label className="text-sm font-medium text-gray-700">
                Service médical <span className="text-red-500">*</span>
              </label>
              <select
                className="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                {...register("service", { required: "Veuillez sélectionner un service" })}
              >
                <option value="">— Sélectionner un service —</option>
                {services?.map((s) => (
                  <option key={s.id} value={s.name}>{s.name}</option>
                ))}
              </select>
              {errors.service && <p className="text-xs text-red-600">{errors.service.message}</p>}
            </div>

            <div className="flex flex-col gap-1">
              <label className="text-sm font-medium text-gray-700">Motif de la consultation</label>
              <textarea
                rows={4}
                placeholder="Décrivez brièvement le motif de votre consultation..."
                className="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"
                {...register("raison")}
              />
            </div>

            <Button type="submit" loading={isPending} className="w-full" size="lg">
              Envoyer la demande
            </Button>
          </form>
        </div>
      </div>
    </div>
  );
}
