<?= $this->extend('_layouts/admin/template'); ?>

<?= $this->section('header'); ?>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Account</li>
  </ol>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="my-5">
  <form id="formProfile" class="col-12 col-md-6 mx-auto" action="<?= base_url('dashboard/account/edit') ?>" method="POST">
    <div class="mb-3 text-center">
      <img class="rounded-circle" loading="lazy" src="<?= "https://gravatar.com/avatar/" . md5(strtolower(auth()->user()->email)) . "?s=100&d=mp" ?>">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label small">Name</label>
      <input required id="name" name="name" value="<?= old('name') ?? auth()->user()->name ?>" type="text" class="form-control rounded-0">
    </div>
    <div class="mb-3">
      <label for="username" class="form-label small">Username</label>
      <input required id="username" name="username" value="<?= old('username') ?? auth()->user()->username ?>" type="text" class="form-control rounded-0">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label small">Email</label>
      <input required id="email" name="email" value="<?= old('email') ?? auth()->user()->email ?>" type="email" class="form-control rounded-0">
      <small class="smaller text-muted">Used for authentication</small>
    </div>
    <div class="mb-3 text-end">
      <?= csrf_field() ?>
      <input type="hidden" name="_method" value="PUT">
      <button type="submit" class="btn btn-success btn-sm rounded-0">
        <span>Update Profile</span>
        <i class="ms-1 ri-send-plane-2-fill"></i>
      </button>

    </div>
    <hr class="my-5 border-2">
  </form>
  <form id="formPassword" class="col-12 col-md-6 mx-auto" action="<?= base_url('dashboard/account/editpassword') ?>" method="POST">
    <div class="mb-3">
      <label for="old_password" class="form-label small">Old password</label>
      <input required id="old_password" name="old_password" type="password" class="form-control rounded-0 <?= isset(session('validation')['old_password']) ? 'is-invalid' : '' ?>" <?= isset(session('validation')['old_password']) ? 'autofocus' : '' ?>>
      <?php if (isset(session('validation')['old_password'])) : ?><div class="invalid-feedback"><?= session('validation')['old_password'] ?></div><?php endif ?>
    </div>
    <div class="mb-3">
      <label for="new_password" class="form-label small">New password</label>
      <input required id="new_password" name="new_password" type="password" class="form-control rounded-0 <?= isset(session('validation')['new_password']) ? 'is-invalid' : '' ?>">
      <?php if (isset(session('validation')['new_password'])) : ?><div class="invalid-feedback"><?= session('validation')['new_password'] ?></div><?php endif ?>
    </div>
    <div class="mb-4">
      <label for="repeat_password" class="form-label small">Confirm password</label>
      <input required id="repeat_password" name="confirm_password" type="password" class="form-control rounded-0 <?= isset(session('validation')['confirm_password']) ? 'is-invalid' : '' ?>">
      <?php if (isset(session('validation')['confirm_password'])) : ?><div class="invalid-feedback"><?= session('validation')['confirm_password'] ?></div><?php endif ?>
    </div>
    <div class="mb-3 text-end">
      <?= csrf_field() ?>
      <input type="hidden" name="_method" value="PUT">
      <button type="submit" class="btn btn-danger btn-sm rounded-0">
        <span>Change Password</span>
        <i class="ms-1 ri-key-2-line"></i>
      </button>
    </div>
  </form>
</div>
<?= $this->endSection(); ?>