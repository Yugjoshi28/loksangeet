<div class="page-wrapper">
    <div class="page-content">

        <div class="card radius-10 shadow-sm">
            <div class="card-body">

                <div class="d-flex align-items-center mb-3">
                    <h5 class="mb-0 fw-bold">User Projects</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light text-uppercase small fw-bold">
                            <tr>
                                <th>Project Name</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($projects)): ?>
                                <?php foreach ($projects as $p): ?>

                                    <tr>
                                        <td class="fw-semibold">
                                            <?= htmlspecialchars($p->project_name) ?>
                                        </td>

                                        <td>
                                            <a href="<?= site_url('project/tasks_by_project/' . $p->id); ?>"
                                                class="btn btn-primary btn-sm radius-30 px-3">
                                                View Tasks
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="2" class="text-center py-4 text-muted">
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