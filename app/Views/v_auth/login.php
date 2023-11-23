<?= $this->extend('_layouts/auth/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-5">
  <div class="row justify-content-center">

        <div class="text-center my-4"><img class="rounded-circle shadow-sm" src="<?=base_url('assets/img/logo.webp')?>" width="50" height="50"></div>
        <h4 class="text-center fw-light">Sign in to <?=APP_NAME?></h4>

    <div class="col-lg-4">

    <?= view('Myth\Auth\Views\_message_block') ?>

      <div class="card rounded-0 bg-body-tertiary mt-3">
        <form class="card-body" action="<?= url_to('login') ?>" method="post">
          <?= csrf_field() ?>
          <?php if ($config->validFields === ['email']): ?>
          <!-- <div class="form-floating mb-3">
            <input name="login" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
              id="inputLogin" type="email" placeholder="<?=lang('Auth.email')?>" />
            <label for="inputLogin"><?=lang('Auth.email')?></label>
            <div class="invalid-feedback"><?=session('errors.login')?></div>
          </div> -->
          <div class="mb-3">
            <label for="inputLogin" class="form-label small"><?=lang('Auth.emailOrUsername')?></label>
            <input name="login" type="text" class="form-control rounded-0 form-control-sm <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="inputLogin" required>
            <div class="invalid-feedback"><?=session('errors.login')?></div>
          </div>
          <?php else: ?>
          <div class="mb-3">
            <label for="inputLogin" class="form-label small"><?=lang('Auth.emailOrUsername')?></label>
            <input name="login" type="text" class="form-control rounded-0 form-control-sm <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="inputLogin" required>
            <div class="invalid-feedback"><?=session('errors.login')?></div>
          </div>

          <!-- <div class="form-floating mb-3">
            <input name="login" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
              id="inputLogin" type="text" placeholder="<?=lang('Auth.emailOrUsername')?>" />
            <label for="inputLogin"><?=lang('Auth.emailOrUsername')?></label>
            <div class="invalid-feedback"><?=session('errors.login')?></div>
          </div> -->
          <?php endif; ?>

          <div class="mb-3">
            <label for="inputPassword" class="form-label small"><?=lang('Auth.password')?></label>
            <input name="password" type="password" class="form-control rounded-0 form-control-sm <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="inputPassword" required>
            <div class="invalid-feedback"><?=session('errors.password')?></div>
          </div>

          <!-- <div class="form-floating mb-3">
            <input name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="inputPassword" type="password" placeholder="<?=lang('Auth.password')?>" />
            <label for="inputPassword"><?=lang('Auth.password')?></label>
            <div class="invalid-feedback"><?=session('errors.password')?></div>
          </div> -->
          <?php if ($config->allowRemembering): ?>
          <div class="form-check mb-3">
            <input class="form-check-input <?php if (old('remember')) : ?> checked <?php endif ?>"
              id="inputRememberPassword" name="remember" type="checkbox" checked />
            <label class="form-check-label" for="inputRememberPassword"><?=lang('Auth.rememberMe')?></label>
          </div>
          <?php endif; ?>
          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <?php if ($config->activeResetter): ?>
            <a class="small" href="<?=url_to('forgot')?>"><?=lang('Auth.forgotYourPassword')?></a>
            <?php endif; ?>
            <button type="submit" class="btn rounded-0 btn-sm btn-success w-100">Sign in</button>
          </div>
        </form>
      </div>

      <?php if ($config->allowRegistration) : ?>
      <div class="card rounded-0 my-3">
        <div class="card-body">
          <div class="small text-center"><a class="link-success fw-medium text-decoration-none" href="<?= url_to('register') ?>">Create an Account</a></div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>