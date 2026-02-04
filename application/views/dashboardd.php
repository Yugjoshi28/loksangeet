<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= DASHBOARD HEADER ================= -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-1">Dashboard</h4>
                <p class="text-muted mb-0">
                    Welcome back,
                    <strong><?= htmlspecialchars(ucfirst($this->session->userdata('user_name') ?? 'User')); ?></strong> 👋
                </p>
            </div>
        </div>

        <!-- ================= TOP WIDGETS ================= -->
        <div class="row g-4 mb-4">

            <!-- ===== Task Overview ===== -->
            <div class="col-xl-7">

                <div class="card radius-10">
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="fw-semibold mb-0">Task Overview</h6>
                            <span class="badge bg-light-primary text-primary">Live</span>
                        </div>

                        <div class="row g-3 text-center">

                            <div class="col-md-4">
                                <a class="text-decoration-none">
                                    <div class="rounded-4 bg-light-warning p-3">
                                        <i class='bx bx-time-five fs-4 text-warning'></i>
                                        <h2 class="fw-bold mt-2 mb-0"><?= $task_counts['pending']; ?></h2>
                                        <small class="text-light-dark">Pending</small>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a class="text-decoration-none">
                                    <div class="rounded-4 bg-light-primary p-3">
                                        <i class='bx bx-loader-circle fs-4 text-primary'></i>
                                        <h2 class="fw-bold mt-2 mb-0"><?= $task_counts['in_progress']; ?></h2>
                                        <small class="text-light-dark">In Progress</small>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a class="text-decoration-none">
                                    <div class="rounded-4 bg-light-success p-3">
                                        <i class='bx bx-check-circle fs-4 text-success'></i>
                                        <h2 class="fw-bold mt-2 mb-0"><?= $task_counts['completed']; ?></h2>
                                        <small class="text-light-dark">Completed</small>
                                    </div>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <!-- ===== Today Tasks ===== -->
            <div class="col-xl-5">

                <div class="card radius-10">
                    <div class="card-body">

                        <h6 class="fw-semibold mb-2">Today's Tasks</h6>

                        <h1 class="fw-bold"><?= $today_tasks; ?></h1>

                        <p class="text-muted mb-2">Assigned today</p>

                        <div class="progress mb-3" style="height:5px;">
                            <div class="progress-bar bg-info" style="width:100%"></div>
                        </div>

                        <div class="d-flex justify-content-between">

                            <small class="text-lightdark">
                                <i class='bx bx-time'></i> Live
                            </small>



                        </div>

                    </div>
                </div>

            </div>

        </div>









































































        <!-- ================= TASK BOARD HEADER ================= -->
        <div class="d-lg-flex align-items-center mb-4 gap-3">
            <h4 class="fw-bold mb-0">My Task Board</h4>

            <!-- <div class="ms-auto position-relative">
                <input type="text" class="form-control ps-5 radius-30" placeholder="Search Task">
                <span class="position-absolute top-50 translate-middle-y ms-3">
                    <i class="bx bx-search"></i>
                </span>
            </div> -->
        </div>

        <?php
        $columns = [
            'pending'     => 'Pending Tasks',
            'completed'   => 'Completed Tasks'
        ];
        ?>

        <?php foreach ($columns as $status => $title): ?>

            <div class="card mb-4 rounded-4">
                <div class="card-header bg-light fw-bold text-uppercase">
                    <?= $title ?>
                </div>

                <div class="card-body table-responsive">
                    <table class="table align-middle mb-0 table-borderless">

                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Project</th>
                                <th>Priority</th>

                                <?php if ($status !== 'completed'): ?>
                                    <th>Time Left</th>
                                    <th>Status</th>
                                <?php else: ?>
                                    <th>Expected</th>
                                    <th>Worked</th>
                                    <th>Result</th>
                                <?php endif; ?>

                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                       <tbody class="align-middle">

                            <?php
                            $found = false;
                            foreach ($tasks as $t):
                                if ($t->status !== $status) continue;
                                $found = true;

                                // Convert minutes → seconds
                                $expectedSeconds = (int)($t->expected_minutes ?? 0) * 60;
                                $workedSeconds = (int)($t->total_seconds ?? 0);


                                $leftSeconds = max(0, $expectedSeconds - $workedSeconds);

                                /* Expected */
                                $eh = floor($expectedSeconds / 3600);
                                $em = floor(($expectedSeconds % 3600) / 60);
                                $es = $expectedSeconds % 60;

                                /* Worked */
                                $wh = floor($workedSeconds / 3600);
                                $wm = floor(($workedSeconds % 3600) / 60);
                                $ws = $workedSeconds % 60;

                                /* Left */
                                $lh = floor($leftSeconds / 3600);
                                $lm = floor(($leftSeconds % 3600) / 60);
                                $ls = $leftSeconds % 60;

                            ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($t->title); ?></strong></td>
                                    <td><?= htmlspecialchars($t->project_name ?? '-'); ?></td>

                                    <td>
                                        <span class="badge <?= $t->priority === 'high'
                                                                ? 'bg-danger'
                                                                : ($t->priority === 'medium' ? 'bg-warning' : 'bg-success'); ?>">
                                            <?= ucfirst($t->priority); ?>
                                        </span>
                                    </td>

                                    <?php if ($status !== 'completed'): ?>
                                        <td><?= "{$lh}h {$lm}m {$ls}s"; ?></td>

                                        <td>
                                            <span class="badge <?= $status === 'in_progress' ? 'bg-info' : 'bg-secondary'; ?>">
                                                <?= ucfirst(str_replace('_', ' ', $status)); ?>
                                            </span>
                                        </td>
                                    <?php else: ?>

                                        <td><?= "{$eh}h {$em}m {$es}s"; ?></td>

                                        <td><?= "{$wh}h {$wm}m {$ws}s"; ?></td>

                                        <td>
                                            <?php
                                            $isDelayed = ($workedSeconds > $expectedSeconds);

                                            ?>
                                            <span class="badge <?= $isDelayed ? 'bg-danger' : 'bg-success'; ?>">
                                                <?= $isDelayed ? 'Delayed' : 'On Time'; ?>
                                            </span>
                                        </td>
                                    <?php endif; ?>


                                    <td class="text-center">
                                        <?php if ($status === 'pending'): ?>
                                            <a href="<?= site_url('task/task_list') ?>"
                                                class="btn btn-sm btn-primary">
                                                View List
                                            </a>




                                        <?php else: ?>
                                            <span class="text-success fw-bold">✔ Finished</span>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>

                            <?php if (!$found): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        No tasks found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endforeach; ?>


        <!-- ================= STOPWATCH + TASK LOGIC ================= -->
        <!-- <script>
            const KEY_RUNNING = "session_running";
            const KEY_LAST_TS = "session_last_ts";
            const KEY_ELAPSED = "session_elapsed";

            let timer = null;
            let elapsedSeconds = 0;

            const display = document.getElementById("display");
            const btnStart = document.getElementById("btnStart");
            const btnStop = document.getElementById("btnStop");

            function formatTime(sec) {
                const h = String(Math.floor(sec / 3600)).padStart(2, '0');
                const m = String(Math.floor((sec % 3600) / 60)).padStart(2, '0');
                const s = String(sec % 60).padStart(2, '0');
                return `${h}:${m}:${s}`;
            }

            function toggleButtons(running) {
                btnStart.classList.toggle("d-none", running);
                btnStop.classList.toggle("d-none", !running);
            }

            // 🔄 RESTORE STATE ON PAGE LOAD
            (function restore() {
                const running = localStorage.getItem(KEY_RUNNING) === "1";
                const savedElapsed = parseInt(localStorage.getItem(KEY_ELAPSED)) || 0;
                const lastTs = parseInt(localStorage.getItem(KEY_LAST_TS)) || null;

                elapsedSeconds = savedElapsed;

                if (running && lastTs) {
                    elapsedSeconds += Math.floor((Date.now() - lastTs) / 1000);
                    startInterval();
                }

                display.innerText = formatTime(elapsedSeconds);
                toggleButtons(running);
            })();

            function startInterval() {
                if (timer) return;

                timer = setInterval(() => {
                    elapsedSeconds++;
                    display.innerText = formatTime(elapsedSeconds);
                }, 1000);
            }

            // ▶ START (or RESUME)
            function startWatch() {
                if (timer) return;

                localStorage.setItem(KEY_RUNNING, "1");
                localStorage.setItem(KEY_LAST_TS, Date.now());
                localStorage.setItem(KEY_ELAPSED, elapsedSeconds);

                toggleButtons(true);
                startInterval();
            }

            // ⏸ STOP (PAUSE)
            function stopWatch() {
                if (!timer) return;

                clearInterval(timer);
                timer = null;

                localStorage.setItem(KEY_RUNNING, "0");
                localStorage.setItem(KEY_ELAPSED, elapsedSeconds);
                localStorage.removeItem(KEY_LAST_TS);

                toggleButtons(false);
            }

            // 🔄 RESET (ONLY ON DONE)
            function resetWatch() {
                if (timer) clearInterval(timer);
                timer = null;

                elapsedSeconds = 0;

                localStorage.removeItem(KEY_RUNNING);
                localStorage.removeItem(KEY_LAST_TS);
                localStorage.removeItem(KEY_ELAPSED);

                display.innerText = "00:00:00";
                toggleButtons(false);
            }

            // 🔗 BRIDGE FUNCTIONS (linked to task buttons)
            function onTaskStart() {
                startWatch();
            }

            function onTaskStop() {
                stopWatch();
            }

            function onTaskDone() {
                resetWatch();
            }
        </script> -->



    </div>