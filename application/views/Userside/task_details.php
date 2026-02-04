<?php
if (empty($task)) {
    echo '<div class="alert alert-danger m-4">Task not found.</div>';
    return;
}

$isPending    = ($task->status === 'pending');
$isInProgress = ($task->status === 'in_progress');
$isCompleted  = ($task->status === 'completed');

/* total worked minutes (from logs) */
$totalSeconds = 0;
if (!empty($logs)) {
    foreach ($logs as $l) {
        if (!empty($l->end_time)) {
            $totalSeconds += strtotime($l->end_time) - strtotime($l->start_time);
        }
    }
}
$workedMinutes = floor($totalSeconds / 60);
?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Task Already Running',
            text: '<?= addslashes($this->session->flashdata("error")) ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= HEADER ================= -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold">Title: <?= htmlspecialchars($task->title) ?></h4>
                <p class="text-muted">Project: <?= htmlspecialchars($task->project_name ?? '') ?></p>
            </div>

            <div class="d-flex gap-2">
                <?php if ($isInProgress): ?>
                    <a href="<?= site_url('task/stop/' . $task->id) ?>"
                        class="btn btn-warning">
                        ⏸ Stop
                    </a>

                    <a href="<?= site_url('task/complete/' . $task->id) ?>"
                        onclick="return confirm('Complete task?')"
                        class="btn btn-success">
                        ✔ Complete
                    </a>

                <?php elseif ($isPending): ?>
                    <a href="<?= site_url('task/start/' . $task->id) ?>"
                        class="btn btn-success">
                        ▶ Start Task
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- ================= ACTIVE SESSION ================= -->
        <?php if (!$isCompleted): ?>
            <div class="card bg-dark text-white rounded-4 mb-4" style="max-width:420px">
                <div class="card-body text-center">
                    <small class="text-secondary text-light">ACTIVE SESSION</small>
                    <h2 id="display" class="fw-bold my-2 text-light ">00:00:00</h2>
                </div>
            </div>
        <?php endif; ?>

        <!-- ================= COMPLETED SUMMARY ================= -->
        <?php if ($isCompleted): ?>
            <div class="card border-success mb-4" style="max-width:420px">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-success">🎉 Task Completed</h5>
                    <p class="mb-1">You completed this task in</p>
                    <h3 class="fw-bold"><?= $workedMinutes ?> minutes</h3>
                </div>
            </div>
        <?php endif; ?>

        <!-- ================= WORK LOGS ================= -->
        <div class="card">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Work Logs</h5>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
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

                            <?php if (!empty($logs)): foreach ($logs as $log): ?>
                                    <?php
                                    $sec = $log->end_time ? strtotime($log->end_time) - strtotime($log->start_time) : 0;
                                    $h = floor($sec / 3600);
                                    $m = floor(($sec % 3600) / 60);
                                    $s = $sec % 60;
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($log->user_name ?? '-') ?></td>
                                        <td><?= htmlspecialchars($log->project_name ?? '-') ?></td>
                                        <td><?= htmlspecialchars($log->task_title ?? '-') ?></td>
                                        <td><?= date('d M Y H:i:s', strtotime($log->start_time)) ?></td>
                                        <td><?= $log->end_time ? date('d M Y H:i:s', strtotime($log->end_time)) : '-' ?></td>
                                        <td><?= "{$h}h {$m}m {$s}s" ?></td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No logs</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= TIMER SCRIPT ================= -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {

                    const display = document.getElementById("display");


                    let seconds = <?= (int)$totalSeconds ?>;


                    <?php
                    if ($isInProgress && !empty($logs)):

                        $activeLog = null;
                        foreach ($logs as $l) {
                            if (empty($l->end_time)) {
                                $activeLog = $l;
                                break;
                            }
                        }

                        if ($activeLog):
                    ?>

                            const SESSION_START = <?= strtotime($activeLog->start_time) ?>;
                            const CURRENT_TIME = Math.floor(Date.now() / 1000);
                            const elapsedSinceStart = CURRENT_TIME - SESSION_START;


                            seconds += elapsedSinceStart;
                    <?php
                        endif;
                    endif;
                    ?>

                    let timer = null;

                    function format(sec) {

                        const totalSec = Math.max(0, sec);
                        const h = String(Math.floor(totalSec / 3600)).padStart(2, '0');
                        const m = String(Math.floor((totalSec % 3600) / 60)).padStart(2, '0');
                        const s = String(totalSec % 60).padStart(2, '0');
                        return `${h}:${m}:${s}`;
                    }

                    function startTimer() {
                        if (timer) return;
                        timer = setInterval(() => {
                            seconds++;
                            display.innerText = format(seconds);
                        }, 1000);
                    }


                    display.innerText = format(seconds);


                    <?php if ($isInProgress): ?>
                        startTimer();
                    <?php endif; ?>

                });
            </script>

        </div>
    </div>