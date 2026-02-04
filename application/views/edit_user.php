<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= HEADER ================= -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Edit User</h4>
                <small class="text-muted">Update user information</small>
            </div>

            <a href="<?= site_url('user'); ?>" class="btn btn-light radius-30">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <!-- ================= CARD ================= -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="<?= site_url('user/update/' . $user->id); ?>" method="post">

                    <div class="row g-4">

                        <!-- NAME -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control radius-30"
                                   value="<?= htmlspecialchars($user->name); ?>"
                                   required>
                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email"
                                   name="email"
                                   class="form-control radius-30"
                                   value="<?= htmlspecialchars($user->email); ?>"
                                   required>
                        </div>

                        <!-- PHONE -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control radius-30"
                                   value="<?= htmlspecialchars($user->phone ?? ''); ?>">
                        </div>

                        <!-- ADDRESS -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Address</label>
                            <input type="text"
                                   name="address"
                                   class="form-control radius-30"
                                   value="<?= htmlspecialchars($user->address ?? ''); ?>">
                        </div>

                        <!-- ROLE -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">User Role</label>
                            <select name="role" class="form-select radius-30">
                                <option value="user" <?= $user->role === 'user' ? 'selected' : '' ?>>
                                    User
                                </option>
                                <option value="admin" <?= $user->role === 'admin' ? 'selected' : '' ?>>
                                    Admin
                                </option>
                            </select>
                        </div>

                    </div>

                    <!-- ================= ACTIONS ================= -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= site_url('user'); ?>" class="btn btn-light radius-30 px-4">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary radius-30 px-4">
                            <i class="bx bx-save"></i> Update User
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
