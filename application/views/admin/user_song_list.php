<div class="page-wrapper">
    <div class="page-content">

        <!-- breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Song Moderation</div>
            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Users Added Songs</li>
                    </ol>
                </nav>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-body">

                <h5 class="mb-3">Pending & Rejected Songs</h5>

                <div class="table-responsive">
                    <table class="table mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>User</th> <!-- ⭐ NEW -->
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody id="songs"></tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    const site_url = "<?= base_url() ?>";

    // ⭐ LOAD SONGS
    function loadSongs() {

        $.ajax({
            url: site_url + "index.php/admin/song/fetch_user_songs",
            type: "GET",
            dataType: "json",

            success: function (res) {

                let html = '';

                if (!res.data.length) {
                    $("#songs").html('<tr><td colspan="6" class="text-center">No songs</td></tr>');
                    return;
                }

                res.data.forEach((s, i) => {

                    // ⭐ STATUS BADGE
                    let badge = s.status == 0
                        ? `<span class="badge bg-warning">Pending</span>`
                        : `<span class="badge bg-danger">Rejected</span>`;

                    // ⭐ ACTIONS
                    let actions = '';

                    // pending → accept reject
                    if (s.status == 0) {

                        actions += `
<a href="javascript:;" class="song-action text-success"
data-id="${s.id}" data-status="1" title="Accept">
<i class="bx bxs-check-circle fs-4"></i>
</a>

<a href="javascript:;" class="song-action text-danger"
data-id="${s.id}" data-status="2" title="Reject">
<i class="bx bxs-x-circle fs-4"></i>
</a>`;
                    }

                    // rejected → edit
                    if (s.status == 2) {

                        actions += `
<a href="${site_url}index.php/admin/song/edit_user_song/${s.id}"
class="text-primary" title="Edit">
<i class="bx bxs-edit fs-4"></i>
</a>`;
                    }

                    // ⭐ ROW
                    html += `
<tr>

<td>${i + 1}</td>

<td>
<span class="badge bg-info text-dark">
${s.user_name ?? '-'}
</span>
</td>

<td><strong>${s.title}</strong></td>

<td>
<div style="max-width:400px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
${s.description ?? ''}
</div>
</td>

<td>${badge}</td>

<td class="text-center">
<div class="d-flex justify-content-center gap-2">
${actions}
</div>
</td>

</tr>`;
                });

                $("#songs").html(html);
            }
        });
    }

    loadSongs();


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

                    setTimeout(loadSongs, 1200);
                });
            }
        });
    });

</script>