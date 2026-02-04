<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= HEADER ================= -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">User Management</h4>
                <small class="text-muted">All registered users</small>
            </div>

            <a href="<?= site_url('user/add'); ?>" class="btn btn-primary radius-30">
                <i class="bx bx-plus"></i> New User
            </a>
        </div>

        <!-- ================= CARD ================= -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Created</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php if (!empty($users)) : ?>
                            <?php $i = 1; foreach ($users as $u): ?>

                                <tr>

                                    <td><?= $i++; ?></td>

                                    <!-- NAME -->
                                    <td class="fw-semibold">
                                        <?= htmlspecialchars($u->name ?? '-'); ?>
                                    </td>

                                    <!-- EMAIL -->
                                    <td>
                                        <?= htmlspecialchars($u->email ?? '-'); ?>
                                    </td>

                                    <!-- PHONE -->
                                    <td>
                                        <?= htmlspecialchars($u->phone ?? '-'); ?>
                                    </td>

                                    <!-- ADDRESS -->
                                    <td class="text-muted">
                                        <?= htmlspecialchars($u->address ?? '-'); ?>
                                    </td>

                                    <!-- ROLE -->
                                    <td>
                                        <span class="badge rounded-pill px-3
                                        <?= ($u->role ?? '') === 'admin'
                                            ? 'bg-light-danger text-danger'
                                            : 'bg-light-primary text-primary' ?>">
                                            <?= ucfirst($u->role ?? 'user'); ?>
                                        </span>
                                    </td>

                                    <!-- CREATED -->
                                    <td>
                                        <?= !empty($u->created_at)
                                            ? date('d M Y', strtotime($u->created_at))
                                            : '-'; ?>
                                    </td>

                                    <!-- ACTIONS -->
                                    <td class="text-center">
                                        <a href="<?= site_url('user/edit/'.$u->id); ?>"
                                           class="btn btn-light btn-sm me-2">
                                            <i class="bx bxs-edit"></i>
                                        </a>

                                        <a href="<?= site_url('user/delete/'.$u->id); ?>"
                                           class="btn btn-light btn-sm"
                                           onclick="return confirm('Delete user?')">
                                            <i class="bx bxs-trash text-danger"></i>
                                        </a>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No users found
                                </td>
                            </tr>

                        <?php endif; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
