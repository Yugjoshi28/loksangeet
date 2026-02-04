<?php
// Prepare values safely
$startDatetime = !empty($task->start_time)
    ? date('Y-m-d\TH:i', strtotime($task->start_time))
    : '';

$dueDate = $task->due_date ?? '';
$dueTime = $task->due_time ?? '';
?>

<div class="page-wrapper">
    <div class="page-content">

        <!-- PAGE TITLE -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Task</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= site_url('dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= site_url('task'); ?>">Task List</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Task</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Edit Task</h5>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?= site_url('task/update/'.$task->id); ?>">

                            <!-- TITLE -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Task Title</label>
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       value="<?= htmlspecialchars($task->title); ?>"
                                       required>
                            </div>

                            <!-- PROJECT -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Project</label>
                                <select name="project_id" class="form-select">
                                    <?php foreach ($projects as $p): ?>
                                        <option value="<?= $p->id ?>"
                                            <?= $p->id == $task->project_id ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($p->project_name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- ASSIGNED USER -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Assign To</label>
                                <select name="user_id" class="form-select">
                                    <?php foreach ($users as $u): ?>
                                        <option value="<?= $u->id ?>"
                                            <?= $u->id == $task->assigned_to ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($u->name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- PRIORITY -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Priority</label>
                                <select name="priority" class="form-select">
                                    <option value="low"    <?= $task->priority=='low'?'selected':'' ?>>Low</option>
                                    <option value="medium" <?= $task->priority=='medium'?'selected':'' ?>>Medium</option>
                                    <option value="high"   <?= $task->priority=='high'?'selected':'' ?>>High</option>
                                </select>
                            </div>

                            <!-- STATUS -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="pending"     <?= $task->status=='pending'?'selected':'' ?>>Pending</option>
                                    <option value="completed"   <?= $task->status=='completed'?'selected':'' ?>>Completed</option>
                                </select>
                            </div>

                            <!-- START DATE TIME -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Start Date & Time</label>
                                <input type="datetime-local"
                                       name="start_time"
                                       class="form-control"
                                       value="<?= $startDatetime ?>">
                            </div>

                            <!-- DUE DATE + TIME -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Due Date</label>
                                    <input type="date"
                                           name="due_date"
                                           class="form-control"
                                           value="<?= $dueDate ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Due Time</label>
                                    <input type="time"
                                           name="due_time"
                                           class="form-control"
                                           value="<?= $dueTime ?>">
                                </div>
                            </div>

                            <!-- ACTIONS -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    Update Task
                                </button>
                                <a href="<?= site_url('task/list'); ?>" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
