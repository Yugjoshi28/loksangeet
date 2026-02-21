<div class="page-wrapper">
    <div class="page-content">

        <h4>Edit User</h4>

        <form method="post" action="<?= base_url('admin/user/update') ?>" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $user->id ?>">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?= $user->name ?>">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="<?= $user->email ?>">
            </div>

            <div class="mb-3">
                <label>Business</label>
                <input type="text" class="form-control" name="business" value="<?= $user->business ?>">
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" class="form-control" name="address" value="<?= $user->address ?>">
            </div>

            <div class="mb-3">
                <label>Taluka</label>
                <input type="text" class="form-control" name="taluka" value="<?= $user->taluka ?>">
            </div>

            <div class="mb-3">
                <label>District</label>
                <input type="text" class="form-control" name="district" value="<?= $user->district ?>">
            </div>

            <div class="mb-3">
                <label>Pincode</label>
                <input type="text" class="form-control" name="pincode" value="<?= $user->pincode ?>">
            </div>

            <div class="mb-3">
                <label>Photo</label>
                <input type="file" class="form-control" name="photo">
            </div>

            <?php if (!empty($user->photo)) { ?>
                <img src="<?= base_url('uploads/profile/' . $user->photo) ?>" width="120">
            <?php } ?>

            <br><br>

            <button class="btn btn-primary">Update</button>

        </form>

    </div>
</div>