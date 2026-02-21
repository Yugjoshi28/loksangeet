<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-body">

                <h5>Edit User Song</h5>

                <form id="editForm">

                    <input type="hidden" id="song_id" value="<?= $song->id ?>">

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" id="title" class="form-control" value="<?= $song->title ?>">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea id="description" class="form-control"><?= $song->description ?></textarea>
                    </div>

                    <div class="d-flex gap-2">

                        <button type="button" id="updateSong" class="btn btn-primary">Update</button>

                        <button type="button" id="approveSong" class="btn btn-success">Approve</button>

                        <button type="button" id="deleteSong" class="btn btn-danger">Delete</button>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    const site_url = "<?= base_url() ?>";

    // ⭐ UPDATE
    $("#updateSong").click(function () {

        $.post(site_url + "index.php/admin/song/update_user_song", {
            id: $("#song_id").val(),
            title: $("#title").val(),
            description: $("#description").val()
        }, function (res) {

            Swal.fire("Updated", "", "success");

        }, 'json');

    });


    // ⭐ APPROVE
    $("#approveSong").click(function () {

        Swal.fire({
            title: "Approve song?",
            showCancelButton: true
        }).then(r => {

            if (r.isConfirmed) {

                $.post(site_url + "index.php/admin/song/approve_song", {
                    id: $("#song_id").val(),
                    status: 1
                }, function () {

                    Swal.fire("Approved", "", "success");

                    setTimeout(() => {
                        window.location = site_url + "index.php/admin/song/user_songs";
                    }, 1000);

                });
            }

        });

    });


    // ⭐ DELETE
    $("#deleteSong").click(function () {

        Swal.fire({
            title: "Delete song?",
            icon: "warning",
            showCancelButton: true
        }).then(r => {

            if (r.isConfirmed) {

                $.post(site_url + "index.php/admin/song/delete_user_song", {
                    id: $("#song_id").val()
                }, function () {

                    Swal.fire("Deleted", "", "success");

                    setTimeout(() => {
                        window.location = site_url + "index.php/admin/song/user_songs";
                    }, 1000);

                });

            }

        });

    });

</script>