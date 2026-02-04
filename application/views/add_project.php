<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= PAGE HEADER ================= -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">
                    <?= isset($project) ? 'Edit Project' : 'Add New Project'; ?>
                </h4>
                <small class="text-muted">
                    <?= isset($project)
                        ? 'Update project details'
                        : 'Create a new project'; ?>
                </small>
            </div>

            <a href="<?= site_url('project'); ?>" class="btn btn-light radius-30">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <!-- ================= MAIN CARD ================= -->
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10 col-12">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <form method="post"
                            action="<?= isset($project)
                                        ? site_url('project/update/' . $project->id)
                                        : site_url('project/store'); ?>">

                            <!-- ================= PROJECT NAME ================= -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Project Name
                                </label>
                                <input type="text"
                                    name="project_name"
                                    class="form-control radius-30"
                                    placeholder="Enter project name"
                                    required
                                    value="<?= isset($project)
                                                ? htmlspecialchars($project->project_name)
                                                : ''; ?>">
                            </div>

                            <!-- ================= PROJECT DESCRIPTION ================= -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Project Description
                                </label>
                                <textarea name="project_description"
                                    class="form-control radius-30"
                                    rows="4"
                                    placeholder="Describe the project"
                                    required><?= isset($project)
                                                    ? htmlspecialchars($project->project_description)
                                                    : ''; ?></textarea>
                            </div>

                            <!-- ================= ACTION BUTTONS ================= -->
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= site_url('project/list'); ?>"
                                    class="btn btn-light radius-30 px-4">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="btn btn-primary radius-30 px-4">
                                    <i class="bx bx-save"></i>
                                    <?= isset($project) ? 'Update Project' : 'Add Project'; ?>
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>