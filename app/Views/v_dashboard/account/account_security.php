<?= $this->extend('_layouts/admin/template') ?>
<?= $this->section('content') ?>
<div class="row">
  <div class="col-xl-6">
    <div class="card mb-4">
      <div class="card-header">Change Password</div>
      <div class="card-body">
        <form>
          <div class="mb-3">
            <label class="small mb-1" for="inputCurrentPassword">Current Password</label>
            <input class="form-control" id="inputCurrentPassword" type="password" placeholder="Enter current password" required>
          </div>
          <div class="mb-3">
            <label class="small mb-1" for="inputNewPassword">New Password</label>
            <input class="form-control" id="inputNewPassword" type="password" placeholder="Enter new password" required>
          </div>
          <div class="mb-3">
            <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
            <input class="form-control" id="inputConfirmPassword" type="password" placeholder="Confirm new password" required>
          </div>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection()?>