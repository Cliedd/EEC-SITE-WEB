<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comptes - Dashboard Admin</title>
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
        <a href="/admin/accounts" class="active">
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
            <h1>Comptes utilisateurs</h1>
        </div>

        <div class="card">
            <div class="card-header">
                Liste des comptes
            </div>
            <div class="card-body">
                <?php if (isset($accounts) && count($accounts) > 0): ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom complet</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Email vérifié</th>
                                <th>Créé le</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($accounts as $account): ?>
                                <tr>
                                    <td><?= htmlspecialchars($account['full_name']) ?></td>
                                    <td><?= htmlspecialchars($account['email']) ?></td>
                                    <td><?= htmlspecialchars($account['phone'] ?? '-') ?></td>
                                    <td>
                                        <span class="badge bg-<?= $account['email_verified'] ? 'success' : 'secondary' ?>">
                                            <?= $account['email_verified'] ? 'Oui' : 'Non' ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($account['created_at'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $account['status'] == 'active' ? 'success' : 'danger' ?>">
                                            <?= ucfirst($account['status']) ?>
                                        </span>
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
                                    <a class="page-link" href="/admin/accounts?page=<?= $current_page - 1 ?>">Précédent</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                    <a class="page-link" href="/admin/accounts?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="/admin/accounts?page=<?= $current_page + 1 ?>">Suivant</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php else: ?>
                    <p class="text-muted">Aucun compte trouvé</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
