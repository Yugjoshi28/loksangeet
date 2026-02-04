<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= HEADER ================= -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Task List</h4>
                <small class="text-muted">Manage all tasks and track progress</small>
            </div>

            <a href="<?= site_url('task/add'); ?>" class="btn btn-primary radius-30">
                <i class="bx bx-plus"></i> Add Task
            </a>
        </div>


        <!-- ================= TABLE CARD ================= -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Title</th>
                                <th>Project</th>
                                <th>Assigned To</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Total Time</th>
                                <th>Due Date</th>
                                <th>Due Status</th>
                                <th class="text-center" width="120">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($tasks)) : ?>
                                <?php foreach ($tasks as $t) : ?>

                                    <?php
                                    /* ===== DUE STATUS ===== */
                                    $dueBadge = '<span class="badge rounded-pill bg-light-secondary text-secondary">No Due</span>';

                                    if (!empty($t->due_date)) {
                                        $today = strtotime(date('Y-m-d'));
                                        $due   = strtotime($t->due_date);
                                        $days  = ($due - $today) / 86400;

                                        if ($days < 0) {
                                            $dueBadge = '<span class="badge rounded-pill bg-light-danger text-danger">Overdue</span>';
                                        } elseif ($days <= 3) {
                                            $dueBadge = '<span class="badge rounded-pill bg-light-warning text-warning">Due Soon</span>';
                                        } else {
                                            $dueBadge = '<span class="badge rounded-pill bg-light-success text-success">On Time</span>';
                                        }
                                    }

                                    /* ===== TIME ===== */
                                    $expectedMinutes = (int) ($t->expected_minutes ?? 0);
                                    $totalMinutes    = (int) ($t->total_minutes ?? 0);

                                    $eh = floor($expectedMinutes / 60);
                                    $em = $expectedMinutes % 60;

                                    $th = floor($totalMinutes / 60);
                                    $tm = $totalMinutes % 60;
                                    ?>

                                    <tr>
                                        <td><strong><?= $t->id ?></strong></td>

                                        <td class="fw-semibold">
                                            <?= htmlspecialchars($t->title) ?>
                                        </td>

                                        <td><?= htmlspecialchars($t->project_name ?? '—') ?></td>

                                        <td><?= htmlspecialchars($t->user_name ?? '—') ?></td>

                                        <!-- PRIORITY -->
                                        <td>
                                            <span class="badge rounded-pill px-3
                                                <?= $t->priority === 'high'
                                                    ? 'bg-light-danger text-danger'
                                                    : ($t->priority === 'medium'
                                                        ? 'bg-light-warning text-warning'
                                                        : 'bg-light-secondary text-secondary') ?>">
                                                <?= ucfirst($t->priority) ?>
                                            </span>
                                        </td>

                                        <!-- STATUS -->
                                        <!-- STATUS -->
                                        <td>
                                            <span class="badge rounded-pill px-3
                                             <?= $t->status === 'completed'
                                        ? 'bg-light-success text-success'
                                        : ($t->status === 'pending'
                                            ? 'bg-light-warning text-warning'
                                            : ($t->status === 'in_progress'
                                                ? 'bg-light-info text-info'
                                                : 'bg-light-secondary text-secondary')) ?>">
                                                <?= ucfirst(str_replace('_', ' ', $t->status)) ?>
                                            </span>
                                        </td>


                                        <!-- TOTAL TIME -->
                                        <td>
                                            <div class="small text-muted">
                                                <strong>E:</strong> <?= $eh ?>h <?= $em ?>m
                                            </div>
                                            <div class="small text-muted">
                                                <strong>W:</strong> <?= $th ?>h <?= $tm ?>m
                                            </div>
                                        </td>

                                        <!-- DUE DATE -->
                                        <td>
                                            <?= $t->due_date ? date('d M Y', strtotime($t->due_date)) : '—' ?>
                                        </td>

                                        <!-- DUE STATUS -->
                                        <td><?= $dueBadge ?></td>

                                        <!-- ACTIONS -->
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center order-actions">
                                                <a href="<?= site_url('task/edit/' . $t->id); ?>"
                                                    class="btn btn-light btn-sm me-2"
                                                    title="Edit">
                                                    <i class="bx bxs-edit"></i>
                                                </a>

                                                <a href="<?= site_url('task/delete/' . $t->id); ?>"
                                                    class="btn btn-light btn-sm"
                                                    title="Delete"
                                                    onclick="return confirm('Delete this task?')">
                                                    <i class="bx bxs-trash text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-4">
                                        No tasks found
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