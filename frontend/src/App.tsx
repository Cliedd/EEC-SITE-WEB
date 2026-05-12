import { lazy, Suspense } from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { Toaster } from "react-hot-toast";
import { AuthProvider } from "./context/AuthContext";
import { Layout } from "./components/layout/Layout";
import { AdminShell } from "./components/layout/AdminShell";
import { ProtectedRoute } from "./components/ProtectedRoute";
import { PageLoader } from "./components/ui/LoadingSpinner";

// Public pages — lazy loaded
const Home         = lazy(() => import("./pages/Home"));
const About        = lazy(() => import("./pages/About"));
const Services     = lazy(() => import("./pages/Services"));
const PatientSpace = lazy(() => import("./pages/PatientSpace"));
const Appointment  = lazy(() => import("./pages/Appointment"));
const Contact      = lazy(() => import("./pages/Contact"));
const Login        = lazy(() => import("./pages/Login"));
const Register     = lazy(() => import("./pages/Register"));

// Admin pages
const AdminDashboard   = lazy(() => import("./pages/admin/Dashboard"));
const AppointmentsAdmin = lazy(() => import("./pages/admin/AppointmentsAdmin"));
const ContactsAdmin    = lazy(() => import("./pages/admin/ContactsAdmin"));
const ServicesAdmin    = lazy(() => import("./pages/admin/ServicesAdmin"));
const VisitorsAdmin    = lazy(() => import("./pages/admin/VisitorsAdmin"));
const AuditLogsAdmin   = lazy(() => import("./pages/admin/AuditLogsAdmin"));

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      retry: 1,
      staleTime: 60_000,
    },
  },
});

export default function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <AuthProvider>
        <BrowserRouter>
          <Toaster position="top-right" toastOptions={{ duration: 4000 }} />
          <Suspense fallback={<PageLoader />}>
            <Routes>
              {/* Public */}
              <Route element={<Layout />}>
                <Route path="/"               element={<Home />} />
                <Route path="/a-propos"       element={<About />} />
                <Route path="/services"       element={<Services />} />
                <Route path="/espace-patient" element={<PatientSpace />} />
                <Route path="/rendez-vous"    element={<Appointment />} />
                <Route path="/contact"        element={<Contact />} />
                <Route path="/login"          element={<Login />} />
                <Route path="/inscription"    element={<Register />} />
              </Route>

              {/* Admin (protected) */}
              <Route element={<ProtectedRoute adminOnly />}>
                <Route element={<AdminShell />}>
                  <Route path="/admin"                element={<AdminDashboard />} />
                  <Route path="/admin/rendez-vous"    element={<AppointmentsAdmin />} />
                  <Route path="/admin/contacts"       element={<ContactsAdmin />} />
                  <Route path="/admin/services"       element={<ServicesAdmin />} />
                  <Route path="/admin/visiteurs"      element={<VisitorsAdmin />} />
                  <Route path="/admin/audit"          element={<AuditLogsAdmin />} />
                </Route>
              </Route>
            </Routes>
          </Suspense>
        </BrowserRouter>
      </AuthProvider>
    </QueryClientProvider>
  );
}
