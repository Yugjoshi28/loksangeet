<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= PAGE HEADER ================= -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Add New Task</h4>
                <small class="text-muted">Create and assign a task</small>
            </div>

            <a href="<?= site_url('task/list'); ?>" class="btn btn-light radius-30">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <!-- ================= FLASH MESSAGES ================= -->
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success border-0 bg-success text-white radius-30">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger border-0 bg-danger text-white radius-30">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- ================= MAIN CARD ================= -->
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9 col-md-10 col-12">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <form method="post" action="<?= site_url('task/store') ?>">

                            <div class="row g-4">

                                <!-- PROJECT -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Project</label>
                                    <select name="project_id"
                                        class="form-select radius-30"
                                        required>
                                        <option value="">Select Project</option>
                                        <?php foreach ($projects as $p): ?>
                                            <option value="<?= $p->id ?>">
                                                <?= htmlspecialchars($p->project_name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- ASSIGN TO -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Assign To</label>
                                    <select name="assigned_to"
                                        class="form-select radius-30"
                                        required>
                                        <option value="">Select User</option>
                                        <?php foreach ($users as $u): ?>
                                            <option value="<?= $u->id ?>">
                                                <?= htmlspecialchars($u->name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- TASK TITLE -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Task Title</label>
                                    <input type="text"
                                        name="title"
                                        class="form-control radius-30"
                                        placeholder="Enter task title"
                                        required>
                                </div>

                                <!-- DESCRIPTION -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea name="description"
                                        class="form-control radius-30"
                                        rows="3"
                                        placeholder="Optional task description"></textarea>
                                </div>

                                <!-- PRIORITY -->
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Priority</label>
                                    <select name="priority"
                                        class="form-select radius-30">
                                        <option value="low">Low</option>
                                        <option value="medium" selected>Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>

                                <!-- START DATE & TIME -->
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Start Date & Time</label>
                                    <input type="datetime-local"
                                        name="start_time"
                                        class="form-control radius-30"
                                        required>
                                </div>

                                <!-- DUE DATE -->
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Due Date</label>
                                    <input type="date"
                                        name="due_date"
                                        class="form-control radius-30">
                                </div>

                                <!-- DURATION -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Estimated Hours</label>
                                    <input type="number"
                                        name="duration_hours"
                                        class="form-control radius-30"
                                        value="0"
                                        min="0">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Estimated Minutes</label>
                                    <input type="number"
                                        name="duration_minutes"
                                        class="form-control radius-30"
                                        value="0"
                                        min="0"
                                        max="59">
                                </div>

                            </div>

                            <!-- ================= ACTION BUTTONS ================= -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="<?= site_url('task'); ?>"
                                    class="btn btn-light radius-30 px-4">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="btn btn-primary radius-30 px-4">
                                    <i class="bx bx-task"></i> Add Task
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>