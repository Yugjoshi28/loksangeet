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
                        <li class="breadcrumb-item active">Certificate List</li>
                    </ol>
                </nav>
            </div>
        </div>

        <hr>

        <!-- success message -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- card -->
        <div class="card">
            <div class="card-body">

                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <h5 class="mb-0">Certificates</h5>

                    <div class="ms-auto">
                        <a href="<?= base_url('admin/certificate/add'); ?>" class="btn btn-primary">
                            <i class="bx bxs-plus-square"></i> Add Certificate
                        </a>
                    </div>
                </div>

                <!-- table -->
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($certificates)): ?>
                                <?php $i = 1;
                                foreach ($certificates as $row): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>

                                        <td>
                                            <img src="<?= base_url($row->image); ?>"
                                                width="70"
                                                class="rounded shadow-sm">
                                        </td>

                                        <td><?= $row->title; ?></td>

                                        <!-- ACTION -->
                                        <td>
                                            <div class="d-flex order-actions">

                                                <!-- EDIT -->
                                                <a href="<?= base_url('admin/certificate/edit/' . $row->id); ?>"
                                                    class="text-primary"
                                                    title="Edit">
                                                    <i class="bx bxs-edit"></i>
                                                </a>

                                                <!-- DELETE -->
                                                <a href="<?= base_url('admin/certificate/delete/' . $row->id); ?>"
                                                    class="ms-2 text-danger"
                                                    title="Delete"
                                                    onclick="return confirm('Delete certificate?')">
                                                    <i class="bx bxs-trash"></i>
                                                </a>

                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No certificates found</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>