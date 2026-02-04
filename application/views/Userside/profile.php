<div class="page-wrapper">
    <div class="page-content">

        <!-- ================= BREADCRUMB ================= -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
        </div>

        <!-- ================= PROFILE FORM ================= -->
        <form action="<?= site_url('user/update_profile'); ?>"
            method="post"
            enctype="multipart/form-data">

            <div class="container">
                <div class="main-body">
                    <div class="row">

                        <!-- ===== LEFT PROFILE CARD ===== -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body text-center">

                                    <div class="position-relative d-inline-block mb-3">
                                        <img id="imagePreview"
                                            src="<?= !empty($user->photo)
                                                        ? base_url('uploads/profile/' . $user->photo)
                                                        : base_url('assets/images/avatars/avatar-2.png'); ?>"
                                            class="rounded-circle p-1 bg-primary"
                                            width="120"
                                            height="120"
                                            style="object-fit:cover;">

                                        <!-- CAMERA BUTTON -->
                                        <label for="imageUpload"
                                            style="position:absolute;bottom:0;right:0;
                                                      background:#008cff;color:#fff;
                                                      border-radius:50%;padding:6px;
                                                      cursor:pointer;border:2px solid #fff;">
                                            <i class="bx bx-camera"></i>
                                        </label>

                                        <input type="file"
                                            name="photo"
                                            id="imageUpload"
                                            hidden
                                            accept="image/*">
                                    </div>

                                    <h4><?= htmlspecialchars($user->name); ?></h4>
                                    <p class="text-secondary mb-1"><?= htmlspecialchars($user->role ?? 'User'); ?></p>
                                    <p class="text-muted font-size-sm">
                                        <?= htmlspecialchars($user->address ?? ''); ?>
                                    </p>

                                    <button type="button" class="btn btn-primary">Follow</button>
                                    <button type="button" class="btn btn-outline-primary">Message</button>

                                </div>
                            </div>
                        </div>

                        <!-- ===== RIGHT PROFILE FORM ===== -->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                name="name"
                                                class="form-control"
                                                value="<?= htmlspecialchars($user->name); ?>"
                                                required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="email"
                                                name="email"
                                                class="form-control"
                                                value="<?= htmlspecialchars($user->email); ?>"
                                                required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                name="phone"
                                                class="form-control"
                                                value="<?= htmlspecialchars($user->phone ?? ''); ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                name="address"
                                                class="form-control"
                                                value="<?= htmlspecialchars($user->address ?? ''); ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary px-4">
                                                Save Changes
                                            </button>
                                            <a href="<?= site_url('login/logout'); ?>" class="btn btn-danger px-4 ms-2">
                                                Logout
                                            </a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </form>
        <!-- <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="d-flex align-items-center mb-3">Project Status</h5>
                        <p>Web Design</p>
                        <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Website Markup</p>
                        <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>One Page</p>
                        <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Mobile Template</p>
                        <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Backend API</p>
                        <div class="progress" style="height: 5px">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->



        <!-- ================= IMAGE PREVIEW SCRIPT ================= -->
        <script>
            document.getElementById('imageUpload').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;

                if (file.size > 10 * 1024 * 1024) {
                    alert('Image must be less than 10MB');
                    e.target.value = '';
                    return;
                }

                document.getElementById('imagePreview').src = URL.createObjectURL(file);
            });
        </script>
    </div>
</div>