<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->get('acceuil', 'Home::acceuil');
$routes->get('a_propos', 'Home::a_propos');
$routes->get('service_medicaux', 'Home::service_medicaux');
$routes->get('espace_peteint', 'Home::espace_peteint');
$routes->get('actualiter', 'Home::actualiter');
$routes->get('Contact', 'Home::Contact');
$routes->get('PrendreRendez_vous', 'Home::PrendreRendez_vous');
$routes->get('sinscrire', 'Home::sinscrire');
$routes->get('creer_un_compte', 'Home::creer_un_compte');

// routes for post data to store in db
$routes->get('Creer_compte', 'Creer_compte::index');
$routes->post('Creer_compte/store', 'Creer_compte::store');
$routes->post('Creer_compte/verifyLogin', 'Creer_compte::verifyLogin');

// Routes for appointments
$routes->get('appointment', 'AppointmentController::index');
$routes->post('appointment/store', 'AppointmentController::store');
$routes->get('appointment/details/(:num)', 'AppointmentController::getDetails/$1');

$routes->get('ContactController', 'ContactController::index');
$routes->post('Contact', 'ContactController::Contact');

// Routes pour l'authentification admin
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/authenticate', 'Auth::authenticate');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/verifyEmail/(:any)', 'Auth::verifyEmail/$1');

// Routes API pour données automatiques
$routes->post('api/track-visitor', 'Api::trackVisitor');
$routes->post('api/appointments/create', 'Api::createAppointment');
$routes->post('api/contacts/create', 'Api::createContact');

// Route pour le dashboard admin
$routes->get('admin', 'Admin::index');
$routes->get('admin/appointments', 'Admin::appointments');
$routes->get('admin/view-appointment/(:num)', 'Admin::viewAppointment/$1');
$routes->post('admin/update-appointment-status', 'Admin::updateAppointmentStatus');
$routes->get('admin/visitors', 'Admin::visitors');
$routes->get('admin/accounts', 'Admin::accounts');
$routes->get('admin/contacts', 'Admin::contacts');
$routes->get('admin/services', 'Admin::services');
$routes->post('admin/toggle-service', 'Admin::toggleService');
$routes->get('admin/get-service-details/(:num)', 'Admin::getServiceDetails/$1');
$routes->get('admin/get-appointment-details/(:num)', 'Admin::getAppointmentDetails/$1');
$routes->post('admin/send-manual-email', 'Admin::sendManualEmail');
$routes->get('admin/logout', 'Admin::logout');

// Routes pour les notifications et nettoyage
$routes->get('admin/get-upcoming-appointments', 'Dashboard::getUpcomingAppointments');
$routes->post('admin/cleanup-expired-appointments', 'Dashboard::cleanupExpiredAppointments');

// Routes pour les logs d'audit
$routes->get('auditlogs', 'AuditLogsController::index');
$routes->get('auditlogs/filterByAction/(:any)', 'AuditLogsController::filterByAction/$1');
$routes->get('auditlogs/userLogs/(:num)', 'AuditLogsController::userLogs/$1');
$routes->get('auditlogs/failedLogins', 'AuditLogsController::failedLogins');
$routes->get('auditlogs/export', 'AuditLogsController::export');
$routes->post('auditlogs/cleanup', 'AuditLogsController::cleanup');

// Routes pour l'upload de fichiers
$routes->post('upload', 'FileUploadController::upload');
$routes->delete('fileupload/delete/(:any)', 'FileUploadController::delete/$1');
$routes->get('fileupload/list', 'FileUploadController::listFiles');

// root pour le formulaire d'inscription
$routes->get('Contact', 'LoginController::index');
$routes->post('Contact/save', 'LoginController::save');//traiter le formulaire d'inscription
$routes->get('Contact/success', 'LoginController::success');//page de succès après inscription
$routes->get('Login/success', 'LoginController::success');//page de succès après inscription
