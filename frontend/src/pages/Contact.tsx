import { useState } from "react";
import { useForm } from "react-hook-form";
import { Mail, Phone, MapPin, Clock } from "lucide-react";
import { Input } from "../components/ui/Input";
import { Button } from "../components/ui/Button";
import { Alert } from "../components/ui/Alert";
import { useCreateContact } from "../hooks/useContacts";
import type { ContactCreate } from "../types";

const contactInfo = [
  { icon: Clock,  title: "Horaires",  text: "24H/24, 7J/7" },
  { icon: MapPin, title: "Adresse",   text: "Avant le stade omnisports Kouekong, Bafoussam" },
  { icon: Mail,   title: "Email",     text: "cmpbafoussam2020@gmail.com", href: "mailto:cmpbafoussam2020@gmail.com" },
  { icon: Phone,  title: "Téléphone", text: "+237 699 573 569 / 654 395 887", href: "tel:+237699573569" },
];

export default function Contact() {
  const [success, setSuccess] = useState(false);
  const { mutateAsync: sendContact, isPending, error } = useCreateContact();
  const { register, handleSubmit, reset, formState: { errors } } = useForm<ContactCreate>();

  const onSubmit = async (data: ContactCreate) => {
    await sendContact(data);
    setSuccess(true);
    reset();
  };

  return (
    <div>
      {/* Hero */}
      <div
        className="relative h-56 flex items-center justify-center bg-cover bg-center"
        style={{ backgroundImage: "url('/ASSETS/IMAGES/SETPR0011 (27).JPG')" }}
      >
        <div className="absolute inset-0 bg-gray-900/65" />
        <div className="relative text-center text-white px-4">
          <h1 className="text-4xl font-extrabold">Nous Contacter</h1>
          <p className="mt-2 text-white/80">Notre équipe vous répondra dans les plus brefs délais</p>
        </div>
      </div>

      <div className="mx-auto max-w-7xl px-4 py-14">
        <div className="grid gap-10 lg:grid-cols-5">
          {/* Form */}
          <div className="lg:col-span-3 bg-white rounded-2xl shadow-card border p-8">
            <h2 className="text-xl font-bold text-gray-900 mb-6">Formulaire de Contact</h2>

            {success && (
              <Alert type="success" message="Votre message a été envoyé avec succès. Nous vous répondrons dès que possible." className="mb-6" />
            )}
            {error && (
              <Alert type="error" message={(error as { response?: { data?: { detail?: string } } })?.response?.data?.detail ?? "Erreur lors de l'envoi du message."} className="mb-6" />
            )}

            <form onSubmit={handleSubmit(onSubmit)} noValidate className="space-y-5">
              <div className="grid gap-5 sm:grid-cols-2">
                <Input
                  label="Nom et Prénom"
                  placeholder="Votre nom complet"
                  required
                  error={errors.name_surName?.message}
                  {...register("name_surName", { required: "Le nom est obligatoire" })}
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
                  {...register("telephone")}
                />
                <Input
                  label="Objet"
                  placeholder="Objet de votre message"
                  required
                  error={errors.objet?.message}
                  {...register("objet", { required: "L'objet est obligatoire" })}
                />
              </div>
              <div className="flex flex-col gap-1">
                <label className="text-sm font-medium text-gray-700">
                  Message <span className="text-red-500">*</span>
                </label>
                <textarea
                  rows={5}
                  placeholder="Votre message..."
                  className="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"
                  {...register("message", { required: "Le message est obligatoire" })}
                />
                {errors.message && <p className="text-xs text-red-600">{errors.message.message}</p>}
              </div>
              <Button type="submit" loading={isPending} className="w-full" size="lg">
                Envoyer le Message
              </Button>
            </form>
          </div>

          {/* Info */}
          <div className="lg:col-span-2 space-y-5">
            <div className="bg-gray-50 rounded-2xl border p-6">
              <h2 className="text-lg font-bold text-gray-900 mb-5">Informations</h2>
              <ul className="space-y-5">
                {contactInfo.map(({ icon: Icon, title, text, href }) => (
                  <li key={title} className="flex items-start gap-4">
                    <div className="h-10 w-10 flex-shrink-0 flex items-center justify-center rounded-full bg-primary-500 text-white">
                      <Icon className="h-5 w-5" />
                    </div>
                    <div>
                      <p className="text-sm font-semibold text-gray-800">{title}</p>
                      {href ? (
                        <a href={href} className="text-sm text-primary-600 hover:underline">{text}</a>
                      ) : (
                        <p className="text-sm text-gray-600">{text}</p>
                      )}
                    </div>
                  </li>
                ))}
              </ul>
            </div>

            {/* Map */}
            <div className="rounded-2xl overflow-hidden shadow-card border">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.8855825873397!2d10.416488374039936!3d5.4343445348630075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x105f903635e7245b%3A0x119da109408bedc0!2sEEC%20Mbouo!5e0!3m2!1sfr!2scm!4v1763802348350!5m2!1sfr!2scm"
                width="100%"
                height="250"
                style={{ border: 0 }}
                allowFullScreen
                loading="lazy"
                referrerPolicy="no-referrer-when-downgrade"
                title="Localisation CMPB"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
