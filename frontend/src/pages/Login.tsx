import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useForm } from "react-hook-form";
import { LogIn } from "lucide-react";
import { Input } from "../components/ui/Input";
import { Button } from "../components/ui/Button";
import { Alert } from "../components/ui/Alert";
import { authService } from "../services/authService";
import { useAuth } from "../hooks/useAuth";

interface FormData {
  email: string;
  mot_de_passe: string;
}

export default function Login() {
  const { login } = useAuth();
  const navigate = useNavigate();
  const [serverError, setServerError] = useState("");

  const { register, handleSubmit, formState: { errors, isSubmitting } } = useForm<FormData>();

  const onSubmit = async (data: FormData) => {
    setServerError("");
    // Essaie d'abord en tant qu'admin, sinon user patient
    try {
      let res;
      try {
        res = await authService.adminLogin({ email: data.email, mot_de_passe: data.mot_de_passe });
      } catch {
        res = await authService.login({ email: data.email, mot_de_passe: data.mot_de_passe });
      }
      login(res.access_token, { name: res.user_name, role: res.role as "user" | "admin" });
      navigate(res.role === "admin" ? "/admin" : "/");
    } catch (err: unknown) {
      const e = err as { response?: { data?: { detail?: string | unknown[] } } };
      const detail = e?.response?.data?.detail;
      setServerError(typeof detail === "string" ? detail : "Identifiant ou mot de passe incorrect");
    }
  };

  return (
    <div className="min-h-[80vh] flex items-center justify-center px-4 py-12 bg-gray-50">
      <div className="w-full max-w-md space-y-6">
        <div className="text-center">
          <div className="mx-auto h-14 w-14 flex items-center justify-center rounded-full bg-primary-500 text-white mb-4">
            <LogIn className="h-7 w-7" />
          </div>
          <h1 className="text-2xl font-bold text-gray-900">Connexion</h1>
          <p className="text-sm text-gray-500 mt-1">Accédez à votre espace personnel ou administrateur</p>
        </div>

        <div className="bg-white rounded-2xl shadow-card border p-8">
          {serverError && <Alert type="error" message={serverError} className="mb-5" />}

          <form onSubmit={handleSubmit(onSubmit)} noValidate className="space-y-5">
            <Input
              label="Email ou identifiant"
              type="text"
              placeholder="votre@email.com"
              required
              autoComplete="username"
              error={errors.email?.message}
              {...register("email", { required: "L'identifiant est obligatoire" })}
            />
            <Input
              label="Mot de passe"
              type="password"
              placeholder="••••••••"
              required
              autoComplete="current-password"
              error={errors.mot_de_passe?.message}
              {...register("mot_de_passe", { required: "Le mot de passe est obligatoire" })}
            />

            <Button type="submit" loading={isSubmitting} className="w-full" size="lg">
              Se connecter
            </Button>
          </form>
        </div>

        <p className="text-center text-sm text-gray-500">
          Pas encore de compte ?{" "}
          <Link to="/inscription" className="text-primary-600 font-medium hover:underline">
            Créer un compte
          </Link>
        </p>
      </div>
    </div>
  );
}
