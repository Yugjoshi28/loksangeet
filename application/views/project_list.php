<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= HEADER ================= -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Project List</h4>
                <small class="text-muted">Manage all projects</small>
            </div>

            <a href="<?= base_url('index.php/project/add') ?>"
                class="btn btn-primary radius-30">
                <i class="bx bx-plus"></i> Add Project
            </a>
        </div>

        <!-- ================= CARD ================= -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th class="text-center" width="120">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($projects)) : ?>
                                <?php foreach ($projects as $p) : ?>
                                    <tr>
                                        <td><strong><?= $p->id ?></strong></td>

                                        <td class="fw-semibold">
                                            <?= htmlspecialchars($p->project_name) ?>
                                        </td>

                                        <td class="text-muted">
                                            <?= htmlspecialchars($p->project_description ?: '—') ?>
                                        </td>

                                        <!-- ACTIONS -->
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center order-actions">
                                                <a href="<?= base_url('index.php/project/edit/' . $p->id) ?>"
                                                    class="btn btn-light btn-sm me-1"
                                                    title="Edit">
                                                    <i class="bx bxs-edit"></i>
                                                </a>

                                                <a href="<?= base_url('index.php/project/delete/' . $p->id) ?>"
                                                    class="btn btn-light btn-sm"
                                                    title="Delete"
                                                    onclick="return confirm('Delete this project and ALL its tasks?');">
                                                    <i class="bx bxs-trash text-danger"></i>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        No projects found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>