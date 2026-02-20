<div class="page-wrapper">
    <div class="page-content">

        <!-- breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Suggestions</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Suggestion List</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end breadcrumb -->

        <hr>

        <!-- flash message -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- card -->
        <div class="card">
            <div class="card-body">

                <!-- header with search -->
                <!-- <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <input type="text" id="searchSuggestion" class="form-control w-25" placeholder="Search suggestion...">
                </div> -->

                <!-- table -->
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Index#</th>
                                <th>User</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="suggestionTable">

                            <?php if (!empty($suggestions)): ?>
                                <?php $i = 1;
                                foreach ($suggestions as $row): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row->user_name; ?></td>
                                        <td><?= $row->message; ?></td>
                                        <td><?= date('d M Y', strtotime($row->created_on)); ?></td>
                                        <td>
                                            <div class="d-flex order-actions align-items-center">
                                                <a href="<?= base_url('admin/suggestion/delete/' . $row->id); ?>"
                                                    class="text-danger ms-2"
                                                    onclick="return confirm('Delete suggestion?')"
                                                    title="Delete">
                                                    <i class="bx bxs-trash fs-5"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No suggestions found.</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    // ⭐ Simple client-side search
    document.getElementById('searchSuggestion').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#suggestionTable tr');

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>