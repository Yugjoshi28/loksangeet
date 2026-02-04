<div class="page-wrapper">
    <div class="page-content">

        <?php
        // 🔥 Detect task status from first log
        $taskCompleted = (!empty($logs) && $logs[0]->task_status == 'completed');
        ?>

        <!-- ================= STATUS CARD ================= -->

        <div class="card radius-10 shadow-sm mb-4">
            <div class="card-body text-center">

                <?php if ($taskCompleted): ?>

                    <h5 class="fw-bold text-success mb-1">
                        🎉 Task Completed
                    </h5>

                    <p class="mb-0 text-muted">
                        This task has been successfully completed.
                    </p>

                <?php else: ?>

                    <h5 class="fw-bold text-warning mb-1">
                        ⏳ Task In Progress
                    </h5>

                    <p class="mb-0 text-muted">
                        Your task is still continuing.
                    </p>

                <?php endif; ?>

            </div>
        </div>

        <!-- ================= LOG TABLE ================= -->

        <div class="card radius-10 shadow-sm">
            <div class="card-body">

                <h5 class="fw-bold mb-3">Task Logs</h5>

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light small text-uppercase fw-bold">
                            <tr>
                                <th>User</th>
                                <th>Project</th>
                                <th>Task</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php if (!empty($logs)): foreach ($logs as $l): ?>

                            <tr>
                                <td><?= htmlspecialchars($l->user_name ?? '-') ?></td>
                                <td><?= htmlspecialchars($l->project_name ?? '-') ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($l->task_title ?? '-') ?></td>

                                <td><?= date('d M Y H:i', strtotime($l->start_time)) ?></td>

                                <td>
                                    <?= $l->end_time ? date('d M Y H:i', strtotime($l->end_time)) : '<span class="badge bg-warning">Running</span>' ?>
                                </td>

                                <td>
                                 
                                        <?= $l->total_time ?? '00:00:00' ?>
                                   
                                </td>
                            </tr>

                        <?php endforeach; else: ?>

                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No Logs Found
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
