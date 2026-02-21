<div class="page-wrapper">
    <div class="page-content">

```
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Table</div>

        <div class="ps-3">
            <nav>
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Users Songs</li>
                </ol>
            </nav>
        </div>
    </div>

    <hr>

    <div class="card">
        <div class="card-body">

            <!-- ⭐ SEARCH (same theme) -->
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <input type="text" id="search" class="form-control w-25" placeholder="Search song...">
            </div>

            <div class="table-responsive">
                <table class="table mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Index#</th>
                            <th>User</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="songs"></tbody>

                </table>
            </div>

        </div>
    </div>

</div>
```

</div>

<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const site_url = "<?= base_url() ?>";

// ⭐ LOAD SONGS
function loadSongs(search = '') {

    $.ajax({
        url: site_url + "index.php/admin/song/fetch_user_songs",
        type: "POST",
        data: { search: search },
        dataType: "json",

        success: function (res) {

            let html = '';

            if (!res.data.length) {
                $("#songs").html('<tr><td colspan="6" class="text-center">No songs found</td></tr>');
                return;
            }

            res.data.forEach((s, i) => {

                // ⭐ STATUS UI (theme matched)
                let statusUI = '';

                if (s.status == 0) {
                    statusUI = `
<div class="d-flex align-items-center text-warning">
<i class="bx bx-time-five font-18 me-1"></i>
<span>Pending</span>
</div>`;
                }

                if (s.status == 2) {
                    statusUI = `
<div class="d-flex align-items-center text-danger">
<i class="bx bx-x-circle font-18 me-1"></i>
<span>Rejected</span>
</div>`;
                }

                // ⭐ ACTION UI
                let actions = `<div class="d-flex order-actions align-items-center">`;

                if (s.status == 0) {

                    actions += `
<a href="javascript:;" class="song-action text-success me-2"
data-id="${s.id}" data-status="1">
<i class="bx bxs-check-circle"></i>
</a>

<a href="javascript:;" class="song-action text-danger"
data-id="${s.id}" data-status="2">
<i class="bx bxs-x-circle"></i>
</a>`;
                }

                if (s.status == 2) {

                    actions += `
<a href="${site_url}index.php/admin/song/edit_user_song/${s.id}" class="text-primary">
<i class="bx bxs-edit"></i>
</a>`;
                }

                actions += `</div>`;

                html += `
<tr>

<td>${i + 1}</td>

<td>${s.user_name ?? '-'}</td>

<td>${s.title}</td>

<td style="max-width:350px;">${s.description ?? ''}</td>

<td>${statusUI}</td>

<td>${actions}</td>

</tr>`;
            });

            $("#songs").html(html);
        }
    });
}

// initial load
loadSongs();

// ⭐ SEARCH
$("#search").keyup(function () {
    loadSongs($(this).val());
});

// ⭐ ACCEPT / REJECT
$(document).on("click", ".song-action", function () {

    let id = $(this).data("id");
    let status = $(this).data("status");

    let text = status == 1 ? "Accept this song?" : "Reject this song?";

    Swal.fire({
        title: text,
        icon: 'question',
        showCancelButton: true
    }).then(res => {

        if (res.isConfirmed) {

            $.post(site_url + "index.php/admin/song/approve_song", { id, status }, function () {

                Swal.fire({
                    icon: 'success',
                    title: 'Updated',
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout(() => loadSongs($("#search").val()), 1200);
            });
        }
    });
});

</script>
