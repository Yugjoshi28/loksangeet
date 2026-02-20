<div class="page-wrapper">
    <div class="page-content">

        <h4>Add Certificate</h4>
        <hr>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('admin/certificate/store'); ?>" enctype="multipart/form-data">

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button class="btn btn-primary">Save</button>

        </form>

    </div>
</div>