<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login-Site</title>

    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-extended.css'); ?>" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <div class="text-center mb-3">
                        <img src="<?php echo base_url('assets/images/logo-icon.png'); ?>" width="60">
                    </div>

                    <h5 class="text-center fw-bold">Syndron Admin</h5>
                    <p class="text-center text-muted">Please log in</p>

                    <!-- LOGIN FORM -->
                    <form method="post" action="<?php echo base_url('index.php/login/auth'); ?>">

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control <?= $this->session->flashdata('login_error') ? 'is-invalid' : ''; ?>"
                                   required>
                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control <?= $this->session->flashdata('login_error') ? 'is-invalid' : ''; ?>"
                                   required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Sign in
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SHOW ERROR ALERT ONLY WHEN LOGIN FAILS -->
<?php if ($this->session->flashdata('login_error')): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Login Failed',
    text: '<?= $this->session->flashdata('login_error'); ?>',
    confirmButtonColor: '#0d6efd'
});
</script>
<?php endif; ?>

</body>
</html>
