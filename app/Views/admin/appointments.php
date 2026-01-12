<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous - Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
        }
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background: var(--primary-color);
            color: white;
            min-height: 100vh;
            padding: 20px 0;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
        }
        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: all 0.3s;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .sidebar a.active {
            background: var(--secondary-color);
            color: white;
            border-left: 4px solid #fff;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .topbar {
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .topbar h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px 8px 0 0;
            padding: 15px 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div style="padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;">
            <h5><i class="bi bi-hospital"></i> EEC Admin</h5>
        </div>
        <a href="/admin">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="/admin/appointments" class="active">
            <i class="bi bi-calendar-check"></i> Rendez-vous
        </a>
        <a href="/admin/visitors">
            <i class="bi bi-people"></i> Visiteurs
        </a>
        <a href="/admin/accounts">
            <i class="bi bi-person-lines-fill"></i> Comptes
        </a>
        <a href="/admin/contacts">
            <i class="bi bi-envelope"></i> Messages
        </a>
        <a href="/admin/services">
            <i class="bi bi-briefcase"></i> Services
        </a>
        <a href="/admin/logout" style="margin-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
        </a>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h1>Rendez-vous</h1>
        </div>

        <div class="card">
            <div class="card-header">
                Liste des rendez-vous
            </div>
            <div class="card-body">
                <?php if (isset($appointments) && count($appointments) > 0): ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Date/Heure</th>
                                <th>Service</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $apt): ?>
                                <tr>
                                    <td><?= htmlspecialchars($apt['name_surName']) ?></td>
                                    <td><?= htmlspecialchars($apt['email']) ?></td>
                                    <td><?= htmlspecialchars($apt['telephone'] ?? '-') ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($apt['date_appointment'])) ?></td>
                                    <td><?= htmlspecialchars($apt['service'] ?? $apt['raison'] ?? '-') ?></td>
                                    <td>
                                        <span class="badge bg-<?= $apt['status'] == 'pending' ? 'warning' : ($apt['status'] == 'confirmed' ? 'success' : 'secondary') ?>">
                                            <?= ucfirst($apt['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group-vertical" role="group">
                                            <button type="button" class="btn btn-sm btn-info mb-1" onclick="showAppointmentDetails(<?= $apt['id_appointment'] ?>)">
                                                <i class="bi bi-eye"></i> Détails
                                            </button>
                                            <form method="post" action="/admin/update-appointment-status" style="display: inline;">
                                                <input type="hidden" name="id_appointment" value="<?= $apt['id_appointment'] ?>">
                                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm mb-1">
                                                    <option value="pending" <?= $apt['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="confirmed" <?= $apt['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                                    <option value="cancelled" <?= $apt['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                </select>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-warning mb-1" onclick="sendManualEmail(<?= $apt['id_appointment'] ?>)">
                                                <i class="bi bi-envelope"></i> Envoyer Email
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav aria-label="Pagination">
                        <ul class="pagination">
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="/admin/appointments?page=<?= $current_page - 1 ?>">Précédent</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                    <a class="page-link" href="/admin/appointments?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="/admin/appointments?page=<?= $current_page + 1 ?>">Suivant</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php else: ?>
                    <p class="text-muted">Aucun rendez-vous trouvé</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Modal pour l'envoi d'email -->
    <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailModalLabel">Envoyer un Email au Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="emailForm">
                        <input type="hidden" id="appointmentId" name="appointment_id">
                        
                        <div class="mb-3">
                            <label for="patientEmail" class="form-label">Email du patient</label>
                            <input type="email" class="form-control" id="patientEmail" name="patient_email" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="emailSubject" class="form-label">Sujet de l'email</label>
                            <input type="text" class="form-control" id="emailSubject" name="subject" value="Rappel de votre rendez-vous - EEC Centre Médical">
                        </div>
                        
                        <div class="mb-3">
                            <label for="emailMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="emailMessage" name="message" rows="6" placeholder="Entrez votre message personnalisé..."></textarea>
                        </div>
                        
                        <div class="alert alert-info">
                            <strong>Informations automatiques incluses:</strong>
                            <ul>
                                <li>Numéro de dossier: <span id="modalDossierNumber"></span></li>
                                <li>Service demandé: <span id="modalService"></span></li>
                                <li>Date et heure: <span id="modalDateTime"></span></li>
                                <li>Numéros d'urgence: +237 657 28 16 10 / 654 23 26 92</li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="sendEmail()">Envoyer Email</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentAppointment = null;

        function showAppointmentDetails(appointmentId) {
            // Charger les informations du rendez-vous
            fetch(`/admin/get-appointment-details/${appointmentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        currentAppointment = data.data;
                        populateDetailsModal(currentAppointment);
                        const modal = new bootstrap.Modal(document.getElementById('detailsModal'));
                        modal.show();
                    } else {
                        alert('Erreur lors du chargement des informations du rendez-vous');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Erreur lors du chargement des informations');
                });
        }

        function populateDetailsModal(appointment) {
            document.getElementById('detailPatientName').textContent = appointment.name_surName;
            document.getElementById('detailEmail').textContent = appointment.email;
            document.getElementById('detailPhone').textContent = appointment.telephone || '-';
            document.getElementById('detailDateTime').textContent = new Date(appointment.date_appointment).toLocaleString('fr-FR');
            document.getElementById('detailService').textContent = appointment.service || appointment.raison || '-';
            document.getElementById('detailStatus').textContent = appointment.status;
            document.getElementById('detailReason').textContent = appointment.raison || '-';
            document.getElementById('detailId').textContent = appointment.id_appointment;
        }

        function sendManualEmail(appointmentId) {
            // Charger les informations du rendez-vous
            fetch(`/admin/get-appointment-details/${appointmentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        currentAppointment = data.data;
                        populateEmailModal(currentAppointment);
                        const modal = new bootstrap.Modal(document.getElementById('emailModal'));
                        modal.show();
                    } else {
                        alert('Erreur lors du chargement des informations du rendez-vous');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Erreur lors du chargement des informations');
                });
        }

        function populateEmailModal(appointment) {
            document.getElementById('appointmentId').value = appointment.id_appointment;
            document.getElementById('patientEmail').value = appointment.email;
            document.getElementById('modalDossierNumber').textContent = appointment.id_appointment;
            document.getElementById('modalService').textContent = appointment.service || appointment.raison;
            document.getElementById('modalDateTime').textContent = new Date(appointment.date_appointment).toLocaleString('fr-FR');
            
            // Message par défaut
            const defaultMessage = `Bonjour ${appointment.name_surName},

Nous vous rappelons votre rendez-vous prévu le ${new Date(appointment.date_appointment).toLocaleString('fr-FR')}.

Informations importantes:
- Numéro de dossier: ${appointment.id_appointment}
- Service: ${appointment.service || appointment.raison}
- Date et heure: ${new Date(appointment.date_appointment).toLocaleString('fr-FR')}

En cas de besoin ou pour toute modification, veuillez contacter:
- +237 657 28 16 10
- +237 654 23 26 92

Cordialement,
EEC Centre Médical`;
            
            document.getElementById('emailMessage').value = defaultMessage;
        }

        function sendEmail() {
            const formData = new FormData(document.getElementById('emailForm'));
            
            fetch('/admin/send-manual-email', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Email envoyé avec succès!');
                    bootstrap.Modal.getInstance(document.getElementById('emailModal')).hide();
                } else {
                    alert('Erreur lors de l\'envoi de l\'email: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de l\'envoi de l\'email');
            });
        }
    </script>
</body>
</html>
