<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Project</th>
                                <th>Task Title</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($tasks)): ?>
                                <?php foreach ($tasks as $task): ?>

                                    <tr>

                                        <!-- PROJECT -->
                                        <td class="fw-semibold">
                                            <?= htmlspecialchars($task->project_name ?? '-') ?>
                                        </td>

                                        <!-- TITLE -->
                                        <td>
                                            <?= htmlspecialchars($task->title) ?>
                                        </td>

                                        <!-- STATUS -->



                                    

                                        <td>
                                            <?php if ($task->status === 'pending'): ?>
                                                <span class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                                    Pending
                                                </span>
                                            <?php elseif ($task->status === 'in_progress'): ?>
                                                <span class="badge rounded-pill bg-light-info text-info px-3">
                                                    In Progress
                                                </span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill bg-light-success text-success px-3">
                                                    Completed
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- ACTION -->
                                        <td class="text-center">

                                            <?php if ($task->status === 'pending'): ?>

                                                <?php if ($running_task_id !== null): ?>


                                                    <a href="javascript:void(0)"
                                                        class="btn btn-secondary btn-sm radius-30 px-4"
                                                        onclick="alertRunning()">
                                                        Start
                                                    </a>

                                                <?php else: ?>


                                                    <a href="<?= site_url('task/start/' . $task->id) ?>"
                                                        class="btn btn-primary btn-sm radius-30 px-4">
                                                        Start
                                                    </a>

                                                <?php endif; ?>

                                            <?php elseif ($task->status === 'in_progress'): ?>


                                                <a href="<?= site_url('task/task_details/' . $task->id) ?>"
                                                    class="btn btn-primary btn-sm radius-30 px-4">
                                                    View
                                                </a>

                                            <?php else: ?>


                                                <a href="<?= site_url('task/task_details/' . $task->id) ?>"
                                                    class="btn btn-outline-primary btn-sm radius-30 px-4">
                                                    View
                                                </a>

                                            <?php endif; ?>

                                        </td>



                                    </tr>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        No tasks assigned
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
        <script>
            function alertRunning() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Task Already Running',
                    text: 'Please stop your current task before starting a new one.',
                    confirmButtonText: 'OK'
                });
            }
        </script>

    </div>
</div>