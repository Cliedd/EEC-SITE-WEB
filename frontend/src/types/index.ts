export interface User {
  idlogin: number;
  name_surName: string;
  email: string;
  telephone: string;
  actif: number;
  email_verified: number;
}

export interface AuthState {
  token: string | null;
  user: { name: string; role: "user" | "admin" } | null;
  isAuthenticated: boolean;
}

export interface Appointment {
  id_appointment: number;
  name_surName: string;
  email: string;
  telephone: string;
  date_appointment: string;
  service: string | null;
  raison: string | null;
  status: "pending" | "confirmed" | "cancelled" | "completed";
  date_creation: string;
}

export interface AppointmentCreate {
  name_surName: string;
  email: string;
  telephone: string;
  date_appointment: string;
  service: string;
  raison?: string;
}

export interface Service {
  id: number;
  name: string;
  description: string | null;
  specialite: string | null;
  icon: string | null;
  is_active: number;
  ordre_affichage: number;
}

export interface Contact {
  id_contact: number;
  name_surName: string;
  email: string;
  telephone: string | null;
  objet: string;
  message: string;
  status: "unread" | "read" | "replied";
  date_creation: string;
}

export interface ContactCreate {
  name_surName: string;
  email: string;
  telephone?: string;
  objet: string;
  message: string;
}

export interface Visitor {
  id_visitor: number;
  name_surName: string;
  email: string;
  telephone: string | null;
  visitor_type: string;
  source_page: string | null;
  ip_address: string | null;
  date_visit: string;
}

export interface AuditLog {
  id_log: number;
  user_id: number | null;
  user_email: string | null;
  action: string;
  entity_type: string | null;
  status: "success" | "failure";
  ip_address: string | null;
  timestamp: string;
}

export interface DashboardStats {
  total_visitors: number;
  total_appointments: number;
  pending_appointments: number;
  total_accounts: number;
  total_contacts: number;
  unread_contacts: number;
}

export interface PaginatedResponse<T> {
  items: T[];
  total: number;
  page: number;
  per_page: number;
  total_pages: number;
}

export interface ApiError {
  detail: string;
}
