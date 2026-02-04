<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= PAGE HEADER ================= -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Add New User</h4>
                <small class="text-muted">Create a new system user</small>
            </div>

            <a href="<?= base_url('index.php/user'); ?>" class="btn btn-light radius-30">
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
            <div class="col-xl-7 col-lg-8 col-md-10 col-12">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <form method="post"
                            action="<?= base_url('index.php/user/store'); ?>"
                            enctype="multipart/form-data">

                            <!-- ================= PROFILE IMAGE ================= -->
                            <div class="text-center mb-4">
                                <img id="previewImage"
                                    src="<?= base_url('assets/images/avatars/avatar-2.png'); ?>"
                                    class="rounded-circle mb-3"
                                    width="120"
                                    height="120"
                                    style="object-fit:cover;border:3px solid #f1f1f1;">

                                <input type="file"
                                    name="photo"
                                    class="form-control radius-30"
                                    accept="image/*"
                                    onchange="previewPhoto(this)">

                                <small class="text-muted d-block mt-1">
                                    JPG / PNG • Max 2MB
                                </small>
                            </div>

                            <!-- ================= FORM FIELDS ================= -->
                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name</label>
                                    <input type="text"
                                        name="name"
                                        class="form-control radius-30"
                                        placeholder="Enter full name"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email"
                                        name="email"
                                        class="form-control radius-30"
                                        placeholder="Enter email"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Password</label>
                                    <input type="password"
                                        name="password"
                                        class="form-control radius-30"
                                        placeholder="Enter password"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Phone</label>
                                    <input type="text"
                                        name="phone"
                                        class="form-control radius-30"
                                        placeholder="Enter phone number">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Address</label>
                                    <input type="text"
                                        name="address"
                                        class="form-control radius-30"
                                        placeholder="Enter address">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">User Role</label>
                                    <select name="role"
                                        class="form-select radius-30"
                                        required>
                                        <option value="">Select role</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>

                            </div>

                            <!-- ================= ACTION BUTTONS ================= -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="<?= base_url('index.php/user'); ?>"
                                    class="btn btn-light radius-30 px-4">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="btn btn-primary radius-30 px-4">
                                    <i class="bx bx-user-plus"></i> Add User
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>




        <!-- ================= IMAGE PREVIEW SCRIPT ================= -->
        <script>
            function previewPhoto(input) {
                if (input.files && input.files[0]) {
                    const file = input.files[0];

                    if (file.size > 2 * 1024 * 1024) {
                        alert('Image must be less than 2MB');
                        input.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('previewImage').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>
    </div>
</div>