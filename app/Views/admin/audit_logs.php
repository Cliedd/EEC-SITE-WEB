<?php $this->extend('admin/base'); ?>

<?php $this->section('content'); ?>
<div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    📊 Journaux d'Audit
                </h2>
            </div>
            <div class="col-auto">
                <a href="/auditlogs/export" class="btn btn-primary">
                    <i class="ti ti-download"></i> Exporter CSV
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-wrapper">
    <div class="container-xl">
        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Total Logs</h3>
                        <div class="text-muted"><?= $total ?> enregistrements</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Page</h3>
                        <div class="text-muted"><?= $page ?> / <?= $totalPages ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Filtrage</h3>
                        <div class="text-muted">
                            <?php if (isset($filterType) && $filterType === 'failed_logins'): ?>
                                Tentatives échouées
                            <?php elseif (isset($filterAction)): ?>
                                Action: <?= htmlspecialchars($filterAction) ?>
                            <?php else: ?>
                                Tous les logs
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des logs -->
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Action</th>
                            <th>Utilisateur</th>
                            <th>IP Address</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logs)): ?>
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td><strong>#<?= $log['id_audit'] ?></strong></td>
                                    <td>
                                        <span class="badge badge-outline"><?= htmlspecialchars($log['action']) ?></span>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($log['user_email']) ?>
                                        <?php if ($log['user_id']): ?>
                                            <br><small class="text-muted">ID: <?= $log['user_id'] ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <code><?= htmlspecialchars($log['ip_address']) ?></code>
                                    </td>
                                    <td>
                                        <?php if ($log['status'] === 'success'): ?>
                                            <span class="badge bg-success">✓ Succès</span>
                                        <?php elseif ($log['status'] === 'failed'): ?>
                                            <span class="badge bg-danger">✗ Échoué</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">⚠ Avertissement</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small><?= date('d/m/Y H:i:s', strtotime($log['created_at'])) ?></small>
                                    </td>
                                    <td>
                                        <?php if ($log['details']): ?>
                                            <button class="btn btn-sm btn-ghost-primary" data-bs-toggle="modal" data-bs-target="#detailsModal<?= $log['id_audit'] ?>">
                                                Voir
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal modal-blur fade" id="detailsModal<?= $log['id_audit'] ?>" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Détails - <?= htmlspecialchars($log['action']) ?></h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <pre><code><?= htmlspecialchars(json_encode(json_decode($log['details']), JSON_PRETTY_PRINT)) ?></code></pre>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            —
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Aucun log trouvé
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1">Première</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page - 1 ?>">Précédente</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page + 1 ?>">Suivante</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $totalPages ?>">Dernière</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .badge-outline {
        background-color: transparent;
        border: 1px solid #ccc;
        color: #333;
    }

    .table-responsive {
        overflow-x: auto;
    }

    code {
        background-color: #f5f5f5;
        padding: 2px 6px;
        border-radius: 3px;
    }
</style>
<?php $this->endSection(); ?>
