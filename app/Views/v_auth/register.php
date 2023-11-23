<?= $this->extend('_layouts/auth/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
          <h3 class="text-center font-weight-light my-4"><?=lang('Auth.register')?></h3>
          <?= view('Myth\Auth\Views\_message_block') ?>
        </div>
        <div class="card-body">
          <form action="<?= url_to('register') ?>" method="POST">
            <?=csrf_field()?>
            <div class="form-floating mb-3">
              <input name="username" type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id="inputUsername" value="<?=old('username')?>" placeholder="<?=lang('Auth.username')?>"/>
              <label for="inputUsername"><?=lang('Auth.username')?></label>
            </div>
            <div class="form-floating mb-3">
              <input name="fullname" type="text" class="form-control" id="inputFullname" value="<?=old('fullname')?>"  placeholder="Full Name"/>
              <label for="inputFullname">Full Name</label>
            </div>

            <div class="form-floating mb-3">
              <input name="email" type="email" class="form-control" id="inputEmail" value="<?=old('email')?>" placeholder="<?=lang('Auth.email')?>"/>
              <label for="inputEmail"><?=lang('Auth.email')?></label>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                  <input name="password" type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="inputPassword" autocomplete="off" placeholder="<?=lang('Auth.password')?>"/>
                  <label for="inputPassword"><?=lang('Auth.password')?></label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                  <input name="pass_confirm" type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" id="inputPasswordConfirm" autocomplete="off" placeholder="<?=lang('Auth.repeatPassword')?>"/>
                  <label for="inputPasswordConfirm"><?=lang('Auth.repeatPassword')?></label>
                </div>
              </div>
            </div>
            <div class="mt-4 mb-0">
              <div class="d-grid"><button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.register')?></button></div>
            </div>
          </form>
        </div>
        <div class="card-footer text-center py-3">
          <div class="small"><?=lang('Auth.alreadyRegistered')?> <a href="<?=url_to('login')?>"><?=lang('Auth.signIn')?></a></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>