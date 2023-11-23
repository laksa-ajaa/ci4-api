<?= $this->extend('_layouts/admin/template') ?>
<?= $this->section('content') ?>
<form class="row" action="<?= route_to('Admin\UserManagement::save') ?>" method="POST" enctype="multipart/form-data">
<?= csrf_field() ?>
  <div class="col">
    <!-- Account details card-->
    <div class="card mb-4">
      <div class="card-header">Add New Account</div>
      <div class="card-body">
          <div class="mb-3">
            <label class="small mb-1" for="inputUsername">Username</label>
            <input name="username" class="form-control" id="inputUsername" type="text" placeholder="Enter your username" autofocus required/>
          </div>
          <div class="row gx-3 mb-3">
            <div class="col-md-6">
              <label class="small mb-1" for="inputName">Name</label>
              <input name="name" class="form-control" id="inputName" type="text" placeholder="Enter your full name" required/>
            </div>
            <div class="col-md-6">
            <label class="small mb-1" for="inputEmailAddress">Email address</label>
            <input name="email" class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" required/>
            </div>
          </div>
          <div class="row gx-3 mb-3">
            <div class="col-md-6">
              <label class="small mb-1" for="inputPassword">Password</label>
              <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Enter your full name" required/>
            </div>
            <div class="col-md-6">
            <label class="small mb-1" for="inputPasswordConfirm">Confirm Password</label>
            <input name="password_confirm" class="form-control" id="inputPasswordConfirm" type="password" placeholder="Enter your email address" required/>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Save changes</button>
      </div>
    </div>
  </div>
</form>
<?= $this->endSection()?>