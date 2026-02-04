<div class="page-wrapper">
    <div class="page-content">

        <div class="card radius-10 shadow-sm">
            <div class="card-body">

                <h5 class="fw-bold mb-3">Project Tasks</h5>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light text-uppercase small fw-bold">
                            <tr>
                                <th>Task Title</th>
                                <th>Assigned User</th>
                                <th>Status</th>
                                <th>Expected</th>
                                <th>Worked</th>
                                <th>Result</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($tasks)): foreach ($tasks as $t): ?>

                                    <?php
                                    // EXPECTED
                                    $expectedSeconds = ((int)$t->expected_minutes) * 60;
                                    $eh = floor($expectedSeconds / 3600);
                                    $em = floor(($expectedSeconds % 3600) / 60);
                                    $es = $expectedSeconds % 60;

                                    // WORKED
                                    $workedSeconds = (int)$t->total_seconds;
                                    $wh = floor($workedSeconds / 3600);
                                    $wm = floor(($workedSeconds % 3600) / 60);
                                    $ws = $workedSeconds % 60;
                                    ?>

                                    <tr>

                                        <td class="fw-semibold"><?= htmlspecialchars($t->title) ?></td>

                                        <td><?= htmlspecialchars($t->assigned_user ?? '-') ?></td>

                                        <td>
                                            <?php if ($t->status == 'pending'): ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            <?php elseif ($t->status == 'in_progress'): ?>
                                                <span class="badge bg-primary">In Progress</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Completed</span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?= "{$eh}h {$em}m {$es}s" ?></td>

                                        <td><?= "{$wh}h {$wm}m {$ws}s" ?></td>

                                        <td>
                                            <?php if ($t->performance == 'on_time'): ?>
                                                <span class="badge bg-success">On Time</span>
                                            <?php elseif ($t->performance == 'delayed'): ?>
                                                <span class="badge bg-danger">Delayed</span>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a href="<?= site_url('project/task_logs/' . $t->id) ?>"
                                                class="btn btn-primary btn-sm radius-30 px-3">
                                                View Logs
                                            </a>
                                        </td>

                                    </tr>

                                <?php endforeach;
                            else: ?>

                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No Tasks Found</td>
                                </tr>

                            <?php endif; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>