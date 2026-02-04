<div class="page-wrapper">
    <div class="page-content">

        <!-- BREADCRUMB -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tasks</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Task History
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- END BREADCRUMB -->

        <div class="card">
            <div class="card-body">

                <!-- HEADER -->
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <div class="position-relative">
                        <input type="text"
                            class="form-control ps-5 radius-30"
                            placeholder="Search Task">
                        <span class="position-absolute top-50 product-show translate-middle-y">
                            <i class="bx bx-search"></i>
                        </span>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Task</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Completed At</th>
                                <th>Expected</th>
                                <th>Worked</th>
                                <th>Result</th>
                                <th>Performance</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($history)) : ?>
                                <?php foreach ($history as $h) : ?>

                                    <?php
                                    // ===============================
                                    // TIME CALCULATION
                                    // ===============================
                                    $expected = (int) ($h->expected_minutes ?? 0);
                                    $worked   = (int) ($h->total_minutes ?? 0);

                                    $eh = floor($expected / 60);
                                    $em = $expected % 60;

                                    $wh = floor($worked / 60);
                                    $wm = $worked % 60;

                                    // ===============================
                                    // RESULT
                                    // ===============================
                                    if ($worked <= $expected) {
                                        $resultBadge = '<div class="badge rounded-pill text-success bg-light-success px-3">On Time</div>';
                                    } else {
                                        $resultBadge = '<div class="badge rounded-pill text-danger bg-light-danger px-3">Delayed</div>';
                                    }

                                    // ===============================
                                    // PERFORMANCE
                                    // ===============================
                                    if ($h->performance === 'excellent') {
                                        $perfBadge = 'bg-light-success text-success';
                                    } elseif ($h->performance === 'improvement') {
                                        $perfBadge = 'bg-light-danger text-danger';
                                    } else {
                                        $perfBadge = 'bg-light-warning text-warning';
                                    }

                                    // ===============================
                                    // DATE
                                    // ===============================
                                    $completedAt = !empty($h->completed_at)
                                        ? date('d M Y H:i', strtotime($h->completed_at))
                                        : '—';
                                    ?>

                                    <tr>
                                        <!-- TASK -->
                                        <td>
                                            <h6 class="mb-0 font-14">
                                                <?= htmlspecialchars($h->title ?? '-') ?>
                                            </h6>
                                        </td>

                                        <!-- USER -->
                                        <td><?= htmlspecialchars($h->name ?? '-') ?></td>

                                        <!-- EMAIL -->
                                        <td><?= htmlspecialchars($h->email ?? '-') ?></td>

                                        <!-- COMPLETED -->
                                        <td><?= $completedAt ?></td>

                                        <!-- EXPECTED -->
                                        <td><?= $eh ?>h <?= $em ?>m</td>

                                        <!-- WORKED -->
                                        <td><?= $wh ?>h <?= $wm ?>m</td>

                                        <!-- RESULT -->
                                        <td><?= $resultBadge ?></td>

                                        <!-- PERFORMANCE -->
                                        <td>
                                            <div class="badge rounded-pill <?= $perfBadge ?> px-3 text-uppercase">
                                                <?= ucfirst(htmlspecialchars($h->performance ?? 'N/A')) ?>
                                            </div>
                                        </td>

                                        <!-- FEEDBACK -->
                                        <td><?= htmlspecialchars($h->feedback ?? '-') ?></td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">
                                        No task history found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </div>
