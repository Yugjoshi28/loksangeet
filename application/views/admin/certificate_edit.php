<div class="page-wrapper">
    <div class="page-content">

        <!-- breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Certificate</div>
            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('admin/certificate'); ?>">List</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-body">

                <h5>Edit Certificate</h5>

                <form action="<?= base_url('admin/certificate/update/' . $certificate->id); ?>"
                    method="post"
                    enctype="multipart/form-data">

                    <!-- TITLE -->
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text"
                            name="title"
                            class="form-control"
                            value="<?= $certificate->title; ?>"
                            required>
                    </div>

                    <!-- OLD IMAGE -->
                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        <img src="<?= base_url($certificate->image); ?>"
                            width="120"
                            class="rounded shadow">
                    </div>

                    <!-- NEW IMAGE -->
                    <div class="mb-3">
                        <label class="form-label">Change Image</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Leave blank to keep old image</small>
                    </div>

                    <!-- BTN -->
                    <button class="btn btn-primary">Update Certificate</button>
                    <a href="<?= base_url('admin/certificate'); ?>" class="btn btn-secondary">Cancel</a>

                </form>

            </div>
        </div>

    </div>
</div>