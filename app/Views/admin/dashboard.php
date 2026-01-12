<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - EEC Centre Médical</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --light-bg: #ecf0f1;
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

        .sidebar .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar .logo h5 {
            margin: 0;
            font-weight: 700;
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

        .sidebar .menu-section {
            margin-top: 20px;
        }

        .sidebar .menu-label {
            padding: 10px 20px;
            font-size: 12px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 600;
            margin-top: 10px;
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
            color: var(--primary-color);
        }

        .topbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--secondary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid var(--secondary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .stat-card h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            font-weight: 600;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .stat-card.success {
            border-left-color: var(--success-color);
        }

        .stat-card.success .number {
            color: var(--success-color);
        }

        .stat-card.warning {
            border-left-color: var(--warning-color);
        }

        .stat-card.warning .number {
            color: var(--warning-color);
        }

        .stat-card.danger {
            border-left-color: var(--danger-color);
        }

        .stat-card.danger .number {
            color: var(--danger-color);
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

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--light-bg);
            border: none;
            font-weight: 600;
            color: var(--primary-color);
        }

        .alert {
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
                padding: 10px 0;
            }

            .main-content {
                margin-left: 0;
            }

            .topbar {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h5><i class="bi bi-hospital"></i> EEC Admin</h5>
        </div>

        <a href="/admin" class="<?= current_url() == base_url('admin') ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="menu-section">
            <div class="menu-label">Gestion</div>
            <a href="/admin/appointments" class="<?= strpos(current_url(), 'appointments') ? 'active' : '' ?>">
                <i class="bi bi-calendar-check"></i> Rendez-vous
            </a>
            <a href="/admin/visitors" class="<?= strpos(current_url(), 'visitors') ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Visiteurs
            </a>
            <a href="/admin/accounts" class="<?= strpos(current_url(), 'accounts') ? 'active' : '' ?>">
                <i class="bi bi-person-lines-fill"></i> Comptes
            </a>
            <a href="/admin/contacts" class="<?= strpos(current_url(), 'contacts') ? 'active' : '' ?>">
                <i class="bi bi-envelope"></i> Messages
            </a>
            <a href="/admin/services" class="<?= strpos(current_url(), 'services') ? 'active' : '' ?>">
                <i class="bi bi-briefcase"></i> Services
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-label">Compte</div>
            <a href="/admin/logout" onclick="return confirm('Êtes-vous sûr?')">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <h1>Dashboard</h1>
            <div class="user-info">
                <span><?= session('admin_nom') ?></span>
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--secondary-color); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                    <?= strtoupper(substr(session('admin_nom'), 0, 1)) ?>
                </div>
            </div>
        </div>

        <!-- Affichage des messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Statistiques -->
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card">
                    <h3>Visiteurs</h3>
                    <div class="number"><?= $stats['total_visitors'] ?? 0 ?></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card warning">
                    <h3>Rendez-vous en attente</h3>
                    <div class="number"><?= $stats['pending_appointments'] ?? 0 ?></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card success">
                    <h3>Comptes créés</h3>
                    <div class="number"><?= $stats['total_accounts'] ?? 0 ?></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card danger">
                    <h3>Messages non lus</h3>
                    <div class="number"><?= $stats['unread_contacts'] ?? 0 ?></div>
                </div>
            </div>
        </div>

        <!-- Rendez-vous récents -->
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-calendar-check"></i> Rendez-vous récents
                    </div>
                    <div class="card-body">
                        <?php if (isset($recent_appointments) && count($recent_appointments) > 0): ?>
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_appointments as $apt): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($apt['name_surName']) ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($apt['date_appointment'])) ?></td>
                                            <td>
                                                <span class="badge bg-<?= $apt['status'] == 'pending' ? 'warning' : ($apt['status'] == 'confirmed' ? 'success' : 'secondary') ?>">
                                                    <?= ucfirst($apt['status']) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <a href="/admin/appointments" class="btn btn-sm btn-primary mt-2">Voir tous les rendez-vous</a>
                        <?php else: ?>
                            <p class="text-muted">Aucun rendez-vous</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Visiteurs récents -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-people"></i> Visiteurs récents
                    </div>
                    <div class="card-body">
                        <?php if (isset($recent_visitors) && count($recent_visitors) > 0): ?>
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>IP</th>
                                        <th>Page</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_visitors as $visitor): ?>
                                        <tr>
                                            <td><code><?= htmlspecialchars($visitor['id_visitor'] ?? 'N/A') ?></code></td>
                                            <td><?= htmlspecialchars($visitor['visitor_type'] ?? 'N/A') ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($visitor['date_visit'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <a href="/admin/visitors" class="btn btn-sm btn-primary mt-2">Voir tous les visiteurs</a>
                        <?php else: ?>
                            <p class="text-muted">Aucun visiteur</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
