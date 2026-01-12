<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Dashboard Admin</title>
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
        .service-card {
            transition: all 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .service-status-available {
            border-left: 4px solid #28a745;
        }
        .service-status-unavailable {
            border-left: 4px solid #dc3545;
            opacity: 0.7;
        }
        .stats-card {
            border-left: 4px solid var(--secondary-color);
            margin-bottom: 20px;
        }
        .stats-card.available {
            border-left-color: #28a745;
        }
        .stats-card.unavailable {
            border-left-color: #dc3545;
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
        <a href="/admin/appointments">
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
        <a href="/admin/services" class="active">
            <i class="bi bi-briefcase"></i> Services
        </a>
        <a href="/admin/logout" style="margin-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
        </a>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h1>Services médicaux</h1>
        </div>

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <h3 class="text-primary"><?= isset($stats) ? $stats['total'] : 0 ?></h3>
                        <p class="mb-0">Total Services</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card available">
                    <div class="card-body text-center">
                        <h3 class="text-success"><?= isset($stats) ? $stats['available'] : 0 ?></h3>
                        <p class="mb-0">Disponibles</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card unavailable">
                    <div class="card-body text-center">
                        <h3 class="text-danger"><?= isset($stats) ? $stats['unavailable'] : 0 ?></h3>
                        <p class="mb-0">Indisponibles</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Liste des services</span>
                </div>
            </div>
            <div class="card-body">
                <?php if (isset($services) && count($services) > 0): ?>
                    <div class="row">
                        <?php foreach ($services as $service): ?>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card service-card <?= $service['is_active'] ? 'service-status-available' : 'service-status-unavailable' ?>">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?= htmlspecialchars($service['name']) ?>
                                            <?php if ($service['is_active']): ?>
                                                <span class="badge bg-success float-end">Disponible</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger float-end">Indisponible</span>
                                            <?php endif; ?>
                                        </h5>
                                        
                                        <?php if (!empty($service['description'])): ?>
                                            <p class="card-text text-muted"><?= htmlspecialchars(substr($service['description'], 0, 120)) ?>...</p>
                                        <?php endif; ?>
                                        
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <small class="text-muted">
                                                Créé le <?= date('d/m/Y', strtotime($service['created_at'])) ?>
                                            </small>
                                            
                                            <div class="btn-group" role="group">
                                                <?php if ($service['is_active']): ?>
                                                    <button type="button" class="btn btn-sm btn-warning" 
                                                            onclick="toggleService(<?= $service['id_service'] ?>, 'disable')"
                                                            title="Désactiver">
                                                        <i class="bi bi-pause-circle"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-sm btn-success" 
                                                            onclick="toggleService(<?= $service['id_service'] ?>, 'enable')"
                                                            title="Activer">
                                                        <i class="bi bi-play-circle"></i>
                                                    </button>
                                                <?php endif; ?>
                                                
                                                <button type="button" class="btn btn-sm btn-info" 
                                                        onclick="viewServiceDetails(<?= $service['id_service'] ?>)"
                                                        title="Détails">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-briefcase" style="font-size: 4rem; color: #ccc;"></i>
                        <h4 class="mt-3 text-muted">Aucun service trouvé</h4>
                        <p class="text-muted">Les services médicaux seront affichés ici.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal pour les détails du service -->
    <div class="modal fade" id="serviceDetailsModal" tabindex="-1" aria-labelledby="serviceDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceDetailsModalLabel">Détails du service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="serviceDetailsContent">
                        <!-- Le contenu sera chargé dynamiquement -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleService(serviceId, action) {
            if (!confirm(`Êtes-vous sûr de vouloir ${action === 'enable' ? 'activer' : 'désactiver'} ce service ?`)) {
                return;
            }

            const formData = new FormData();
            formData.append('service_id', serviceId);
            formData.append('action', action);

            fetch('/admin/toggle-service', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(`Service ${action === 'enable' ? 'activé' : 'désactivé'} avec succès`);
                    location.reload();
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la mise à jour du service');
            });
        }

        function viewServiceDetails(serviceId) {
            fetch(`/admin/get-service-details/${serviceId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const service = data.service;
                        const content = `
                            <div class="row">
                                <div class="col-12">
                                    <h6><strong>Nom du service:</strong></h6>
                                    <p>${service.name}</p>
                                    
                                    <h6><strong>Description:</strong></h6>
                                    <p>${service.description || 'Aucune description'}</p>
                                    
                                    <h6><strong>Statut:</strong></h6>
                                    <p>
                                        <span class="badge bg-${service.is_active ? 'success' : 'danger'}">
                                            ${service.is_active ? 'Disponible' : 'Indisponible'}
                                        </span>
                                    </p>
                                    
                                    <h6><strong>Créé le:</strong></h6>
                                    <p>${new Date(service.created_at).toLocaleDateString('fr-FR')}</p>
                                    
                                    ${service.updated_at ? `
                                        <h6><strong>Dernière modification:</strong></h6>
                                        <p>${new Date(service.updated_at).toLocaleDateString('fr-FR')}</p>
                                    ` : ''}
                                </div>
                            </div>
                        `;
                        document.getElementById('serviceDetailsContent').innerHTML = content;
                        
                        const modal = new bootstrap.Modal(document.getElementById('serviceDetailsModal'));
                        modal.show();
                    } else {
                        alert('Erreur lors du chargement des détails: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Erreur lors du chargement des détails');
                });
        }
    </script>
</body>
</html>
