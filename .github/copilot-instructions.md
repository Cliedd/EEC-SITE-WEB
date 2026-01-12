# Copilot Instructions - EEC Centre Médical

## Project Overview

**EEC Centre Médical** is a CodeIgniter 4 medical appointment management system with admin dashboard. The system handles patient registration, appointment scheduling, email notifications, and admin operations.

**Key Stack**: PHP 8.1+, CodeIgniter 4, MySQL, Gmail SMTP email integration.

## Architecture Principles

### 1. Service-Based Email System
All email operations route through `App\Services\EmailService` (single source of truth). Never send emails directly via `$email = service('email')`.

**Pattern**:
```php
$emailService = new EmailService();
$emailService->sendVerificationEmail($email, $userName, $link);
```

**Available Methods**:
- `sendVerificationEmail()` - Account verification
- `sendAppointmentConfirmation()` - Patient appointment confirmation
- `sendNewAppointmentNotificationToAdmin()` - Alert admin on new booking
- `sendAccountCreatedEmail()` - Welcome email
- `sendPasswordResetEmail()` - Password recovery
- `getError()` - Retrieve last error message

### 2. Direct Database Access (Simplified Auth Pattern)
Authentication (`Auth.php`) uses direct database queries instead of heavy model abstractions. This approach prioritizes:
- Clarity and debuggability
- Minimal dependencies
- Fast iteration

**Pattern**:
```php
$this->db = \Config\Database::connect();
$admin = $this->db->table('admin_users')->where('email', $email)->get()->getRow('array');
```

Do NOT refactor to pure Model-based queries without updating all dependent code.

### 3. Session & Security Checks
Admin access requires:
1. Email address verified in `email_verifications` table (verified_at NOT NULL)
2. Admin record active in `admin_users` (actif = 1)
3. Password verified via `password_verify()` against bcrypt hash

Sessions stored in `$_SESSION['admin_id']`, `$_SESSION['admin_email']`.

### 4. Model Naming Convention
Models are suffixed with `Model`: `AdminUserModel`, `AppointmentModel`, `EmailVerificationModel`. Located in `app/Models/`.

All models extend `CodeIgniter\Model` and define `protected $table = 'table_name'`.

## Data Model

### Core Tables
- **admin_users**: Admin accounts (email, mot_de_passe as bcrypt, actif status)
- **appointments**: Scheduled appointments (patient info, date, service, status)
- **users**: Patient accounts (from Creer_compteModel)
- **email_verifications**: Token-based verification (entity_type, verified_at timestamp)
- **audit_logs**: Security event tracking
- **services**: Medical services offered

### Key Constraints
- Passwords stored as bcrypt hashes (use `password_hash($password, PASSWORD_DEFAULT)`)
- Dates/times in format `Y-m-d H:i:s`
- Email verification via 32-byte random tokens, 24-hour expiration

## Common Tasks

### Adding an Email Notification Type
1. Create template in `app/Views/emails/{type}.php` (use inline CSS)
2. Add method to `EmailService` that calls `view()` and `$this->send()`
3. Call service from controller after action succeeds
4. Log in audit_logs if sensitive operation

### Updating Admin Dashboard
Dashboard located at `app/Views/admin/dashboard.php`. Uses:
- Session variables: `$_SESSION['admin_id']`, `$_SESSION['admin_email']`
- Database queries for statistics/lists
- Form POST to Admin controller

### Debugging Authentication
1. Check `email_verifications` table for verified_at status
2. Verify `password_verify()` against stored hash in `admin_users`
3. Ensure `actif = 1` in admin_users record
4. Check `$_SESSION` values after login

## File Organization

```
app/
  Config/
    - Database.php (MySQL: eecbafoussam)
    - Email.php (Gmail SMTP via smtp.gmail.com:587)
  Controllers/
    - Auth.php (login/verify, uses direct DB)
    - Admin.php (dashboard operations)
    - AppointmentController.php (schedules, sends emails)
    - Creer_compte.php (patient registration, triggers verification email)
  Models/
    - AdminUserModel
    - AppointmentModel
    - EmailVerificationModel
    - ServiceModel
  Services/
    - EmailService.php (centralized email handling)
  Views/
    - admin/ (dashboard pages)
    - emails/ (7 HTML templates)
```

## Testing & Debugging Commands

```bash
# Verify database setup
php spark db:seed

# Test authentication flow
php quick_test.php

# Validate email configuration
# Check app/Config/Email.php settings match Gmail credentials

# Run setup (creates admin accounts, tables)
php setup_system.php
```

## Important Notes

- **No ORM Complexity**: Avoid adding Eloquent-style abstractions. Stick to CodeIgniter's Query Builder or raw queries.
- **Email is Critical**: All customer-facing operations (registration, appointments) trigger emails. Never skip email sending.
- **Session-Based Auth**: No JWT tokens. Sessions stored server-side with `$_SESSION`.
- **Audit Trail**: Sensitive operations should log to `audit_logs` table.
- **Admin-Only Features**: Always check `if_admin_logged_in()` or session existence before dashboard access.

## Project Status

✅ **Email system fully implemented** (7 templates, 6 methods, Gmail SMTP)
✅ **Admin dashboard created and operational**
✅ **Patient registration with verification** workflow complete
✅ **Appointment scheduling** with notifications

**Avoid Breaking**: The email integration is production-critical. Test any Auth changes thoroughly.
