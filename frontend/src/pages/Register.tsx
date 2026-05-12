import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useForm } from "react-hook-form";
import { UserPlus, CheckCircle } from "lucide-react";
import { Input } from "../components/ui/Input";
import { Button } from "../components/ui/Button";
import { Alert } from "../components/ui/Alert";
import { authService } from "../services/authService";

interface FormData {
  name_surName: string;
  email: string;
  telephone: string;
  mot_de_passe: string;
  confirm: string;
}

export default function Register() {
  const navigate = useNavigate();
  const [success, setSuccess] = useState(false);
  const [serverError, setServerError] = useState("");
  const { register, handleSubmit, watch, formState: { errors, isSubmitting } } = useForm<FormData>();

  const onSubmit = async (data: FormData) => {
    setServerError("");
    try {
      await authService.register({
        name_surName: data.name_surName,
        email: data.email,
        telephone: data.telephone,
        mot_de_passe: data.mot_de_passe,
      });
      setSuccess(true);
    } catch (err: unknown) {
      const e = err as { response?: { data?: { detail?: string } } };
      setServerError(e?.response?.data?.detail ?? "Erreur lors de la création du compte");
    }
  };

  if (success) {
    return (
      <div className="min-h-[70vh] flex items-center justify-center px-4">
        <div className="max-w-md w-full text-center space-y-6 bg-white rounded-2xl shadow-card border p-10">
          <div className="flex justify-center">
            <div className="h-20 w-20 flex items-center justify-center rounded-full bg-green-100">
              <CheckCircle className="h-10 w-10 text-green-600" />
            </div>
          </div>
          <h2 className="text-2xl font-bold text-gray-900">Compte créé !</h2>
          <p className="text-gray-500">Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.</p>
          <Button onClick={() => navigate("/login")} className="w-full" size="lg">
            Se connecter
          </Button>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-[80vh] flex items-center justify-center px-4 py-12 bg-gray-50">
      <div className="w-full max-w-md space-y-6">
        <div className="text-center">
          <div className="mx-auto h-14 w-14 flex items-center justify-center rounded-full bg-primary-500 text-white mb-4">
            <UserPlus className="h-7 w-7" />
          </div>
          <h1 className="text-2xl font-bold text-gray-900">Créer un compte</h1>
          <p className="text-sm text-gray-500 mt-1">Rejoignez l'espace patient du CMPB</p>
        </div>

        <div className="bg-white rounded-2xl shadow-card border p-8">
          {serverError && <Alert type="error" message={serverError} className="mb-5" />}

          <form onSubmit={handleSubmit(onSubmit)} noValidate className="space-y-5">
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
              placeholder="votre@email.com"
              required
              autoComplete="email"
              error={errors.email?.message}
              {...register("email", { required: "L'email est obligatoire", pattern: { value: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, message: "Email invalide" } })}
            />
            <Input
              label="Téléphone"
              type="tel"
              placeholder="+237 XXX XXX XXX"
              required
              error={errors.telephone?.message}
              {...register("telephone", { required: "Le téléphone est obligatoire" })}
            />
            <Input
              label="Mot de passe"
              type="password"
              placeholder="Minimum 8 caractères"
              required
              autoComplete="new-password"
              error={errors.mot_de_passe?.message}
              {...register("mot_de_passe", { required: "Le mot de passe est obligatoire", minLength: { value: 8, message: "Minimum 8 caractères" } })}
            />
            <Input
              label="Confirmer le mot de passe"
              type="password"
              placeholder="Répétez le mot de passe"
              required
              autoComplete="new-password"
              error={errors.confirm?.message}
              {...register("confirm", {
                required: "Veuillez confirmer le mot de passe",
                validate: (val) => val === watch("mot_de_passe") || "Les mots de passe ne correspondent pas",
              })}
            />
            <Button type="submit" loading={isSubmitting} className="w-full" size="lg">
              Créer mon compte
            </Button>
          </form>
        </div>

        <p className="text-center text-sm text-gray-500">
          Déjà inscrit ?{" "}
          <Link to="/login" className="text-primary-600 font-medium hover:underline">Se connecter</Link>
        </p>
      </div>
    </div>
  );
}
