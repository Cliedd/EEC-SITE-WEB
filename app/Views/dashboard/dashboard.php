<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur - EEC Centre Médical</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('ASSETS/extensions/@icon/dripicons/dripicons.css'); ?>">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background-color: #2c3e50;
            color: white;
            min-height: 100vh;
            padding: 20px 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }
        .sidebar a:hover {
            background-color: #34495e;
            border-left-color: #3498db;
        }
        .sidebar a.active {
            background-color: #3498db;
            border-left-color: #2980b9;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-left: 4px solid #3498db;
        }
        .stat-card.pending {
            border-left-color: #f39c12;
        }
        .stat-card.confirmed {
            border-left-color: #27ae60;
        }
        .stat-card.danger {
            border-left-color: #e74c3c;
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
        }
        .stat-label {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }
        .table-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .badge-pending {
            background-color: #f39c12;
        }
        .badge-confirmed {
            background-color: #27ae60;
        }
        .badge-cancelled {
            background-color: #e74c3c;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .action-buttons button {
            padding: 5px 10px;
            font-size: 12px;
        }
        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }
        .header {
            background: white;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header h1 {
            color: #2c3e50;
            margin: 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 style="padding: 20px; border-bottom: 1px solid #34495e;">EEC Admin</h4>
        <div style="padding: 15px 20px; color: #ecf0f1; font-size: 12px; border-bottom: 1px solid #34495e;">
            <p style="margin: 0 0 5px 0;"><strong>👤 Connecté comme:</strong></p>
            <p style="margin: 0; color: #3498db;"><?= session()->get('admin_email'); ?></p>
        </div>
        <a href="#overview" class="nav-link active" onclick="showTab('overview')">📊 Vue d'ensemble</a>
        <a href="#appointments" class="nav-link" onclick="showTab('appointments')">📅 Rendez-vous</a>
        <a href="#visitors" class="nav-link" onclick="showTab('visitors')">👥 Visiteurs</a>
        <a href="#users" class="nav-link" onclick="showTab('users')">👤 Utilisateurs</a>
        <hr style="margin: 20px 0; border-color: #34495e;">
        <a href="<?= base_url('auth/logout'); ?>" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter?')">🚪 Déconnexion</a>
        <a href="<?= base_url('/'); ?>">Retour au site</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Dashboard Administrateur</h1>
            <p class="text-muted">Gestion complète du site EEC Centre Médical</p>
        </div>

        <!-- Overview Tab -->
        <div id="overview" class="tab-pane active">
            <!-- Notifications Area -->
            <div id="notifications-area" class="mb-4">
                <!-- Notifications will be injected here by JavaScript -->
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number"><?= $totalAppointments; ?></div>
                        <div class="stat-label">Total Rendez-vous</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card pending">
                        <div class="stat-number"><?= $pendingAppointments; ?></div>
                        <div class="stat-label">En attente</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card confirmed">
                        <div class="stat-number"><?= $confirmedAppointments; ?></div>
                        <div class="stat-label">Confirmés</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card danger">
                        <div class="stat-number"><?= $totalVisitors; ?></div>
                        <div class="stat-label">Total Visiteurs</div>
                    </div>
                </div>
            </div>

            <!-- Visitor Types -->
            <?php if (!empty($visitorsByType)): ?>
            <div class="table-container">
                <h4>Visiteurs par Type</h4>
                <div class="row mt-3">
                    <?php foreach ($visitorsByType as $type => $count): ?>
                    <div class="col-md-4">
                        <div class="stat-card" style="border-left-color: #9b59b6;">
                            <div class="stat-number"><?= $count; ?></div>
                            <div class="stat-label"><?= ucfirst(str_replace('_', ' ', $type)); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Recent Appointments -->
            <div class="table-container">
                <h4>Rendez-vous Récents</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Date</th>
                                <th>Service</th>
                                <th>Raison</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentAppointments as $appointment): ?>
                            <tr>
                                <td><?= $appointment['id_appointment']; ?></td>
                                <td><?= $appointment['name_surName']; ?></td>
                                <td><?= $appointment['email']; ?></td>
                                <td><?= $appointment['telephone']; ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($appointment['date_appointment'])); ?></td>
                                <td><?= $appointment['service']; ?></td>
                                <td><?= substr($appointment['raison'], 0, 30); ?></td>
                                <td>
                                    <span class="badge badge-<?= $appointment['status']; ?>">
                                        <?= ucfirst($appointment['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-info" onclick="updateStatus(<?= $appointment['id_appointment']; ?>)">Modifier</button>
                                        <button class="btn btn-sm btn-warning" onclick="sendEmail(<?= $appointment['id_appointment']; ?>)">Email</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteAppointment(<?= $appointment['id_appointment']; ?>)">Supprimer</button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Appointments Tab -->
        <div id="appointments" class="tab-pane">
            <div class="table-container">
                <h4>Tous les Rendez-vous</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Date Rendez-vous</th>
                                <th>Date Création</th>
                                <th>Service</th>
                                <th>Raison</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <td><?= $appointment['id_appointment']; ?></td>
                                <td><?= $appointment['name_surName']; ?></td>
                                <td><?= $appointment['email']; ?></td>
                                <td><?= $appointment['telephone']; ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($appointment['date_appointment'])); ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($appointment['date_creation'])); ?></td>
                                <td><?= $appointment['service']; ?></td>
                                <td><?= substr($appointment['raison'], 0, 30); ?></td>
                                <td>
                                    <span class="badge badge-<?= $appointment['status']; ?>">
                                        <?= ucfirst($appointment['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-info" onclick="updateStatus(<?= $appointment['id_appointment']; ?>)">Modifier</button>
                                        <button class="btn btn-sm btn-warning" onclick="sendEmail(<?= $appointment['id_appointment']; ?>)">Email</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteAppointment(<?= $appointment['id_appointment']; ?>)">Supprimer</button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Visitors Tab -->
        <div id="visitors" class="tab-pane">
            <div class="table-container">
                <h4>Tous les Visiteurs</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Type de Visite</th>
                                <th>Date Visite</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($visitors as $visitor): ?>
                            <tr>
                                <td><?= $visitor['id_visitor']; ?></td>
                                <td><?= $visitor['name_surName']; ?></td>
                                <td><?= $visitor['email']; ?></td>
                                <td><?= $visitor['telephone']; ?></td>
                                <td>
                                    <span class="badge" style="background-color: #9b59b6;">
                                        <?= ucfirst(str_replace('_', ' ', $visitor['visitor_type'])); ?>
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($visitor['date_visit'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Users Tab -->
        <div id="users" class="tab-pane">
            <div class="table-container">
                <h4>Tous les Utilisateurs</h4>
                <p class="text-muted">Total: <?= $totalUsers; ?> utilisateurs</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Date Création</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($users) && is_array($users)): ?>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['idlogin']; ?></td>
                                    <td><?= $user['name_surName']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td><?= $user['telephone']; ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($user['Date-creation'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center">Aucun utilisateur</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-pane');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabName).classList.add('active');

            // Update active nav link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => link.classList.remove('active'));
            event.target.classList.add('active');
        }

        function updateStatus(appointmentId) {
            const newStatus = prompt('Entrez le nouveau statut (pending/confirmed/cancelled):');
            if (newStatus) {
                fetch('<?= base_url('admin/updateAppointmentStatus'); ?>/' + appointmentId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'status=' + newStatus
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Statut mis à jour avec succès');
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function sendEmail(appointmentId) {
            if (confirm('Êtes-vous sûr de vouloir envoyer un email de rappel?')) {
                fetch('<?= base_url('admin/sendEmailFromDashboard'); ?>/' + appointmentId, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Email envoyé avec succès');
                    } else {
                        alert('Erreur: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function deleteAppointment(appointmentId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous?')) {
                fetch('<?= base_url('admin/deleteAppointment'); ?>/' + appointmentId, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Rendez-vous supprimé');
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        // Push Notifications System
        let notificationsInterval;

        function checkUpcomingAppointments() {
            fetch('<?= base_url('admin/get-upcoming-appointments'); ?>')
                .then(response => response.json())
                .then(data => {
                    const notificationsArea = document.getElementById('notifications-area');
                    notificationsArea.innerHTML = '';

                    if (data.status === 'success' && data.appointments.length > 0) {
                        data.appointments.forEach(appointment => {
                            const notification = document.createElement('div');
                            notification.className = 'alert alert-warning alert-dismissible fade show';
                            notification.innerHTML = `
                                <strong>⏰ Rappel:</strong> 
                                ${appointment.name_surName} a un rendez-vous dans ${appointment.time_until} 
                                (${appointment.service} à ${appointment.time})
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            `;
                            notificationsArea.appendChild(notification);
                        });
                    }
                })
                .catch(error => console.error('Error checking appointments:', error));
        }

        // Start notifications check every 5 minutes
        function startNotifications() {
            checkUpcomingAppointments();
            notificationsInterval = setInterval(checkUpcomingAppointments, 300000); // 5 minutes
        }

        // Initialize notifications when page loads
        document.addEventListener('DOMContentLoaded', startNotifications);
    </script>
</body>
</html>
