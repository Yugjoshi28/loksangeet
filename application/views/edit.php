<div class="page-wrapper">
    <div class="page-content">

        <div class="row justify-content-center mt-4">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-header">
                        <h5>Edit Project</h5>
                    </div>

                    <div class="card-body">

                        <form method="post"
                              action="<?= base_url('index.php/project/update/'.$project->id) ?>">

                            <div class="mb-3">
                                <label class="form-label">Project Name</label>
                                <input type="text"
                                       name="project_name"
                                       class="form-control"
                                       value="<?= $project->project_name ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="project_description"
                                          class="form-control"
                                          rows="4"><?= $project->project_description ?></textarea>
                            </div>

                            <button class="btn btn-primary">Update</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
