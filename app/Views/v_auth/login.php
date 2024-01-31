<?= $this->extend('_layouts/auth/template') ?>

<?= $this->section('title') ?>Login - RND API<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="my-4 py-4">

  <div class="header my-4">
    <div class="text-center my-3"><img class="rounded-circle shadow-sm" src="<?= base_url('assets/img/logo.webp') ?>" width="65" height="65"></div>
    <h4 class="text-center fw-light">Sign in to Continue</h4>
  </div>

  <div class="col-12 col-sm-7 col-md-5 col-lg-4 mx-auto px-2">

    <?php if (session('error') !== null) : ?>
      <div class="mt-3">
        <?php if (session('error') !== null) : ?>
          <div class="alert alert-danger alert-dismissible fade show rounded-0 small" role="alert">
            <span><?= session('error') ?></span>
            <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif (session('errors') !== null) : ?>
          <div class="alert alert-danger alert-dismissible fade show rounded-0 small" role="alert">
            <?php if (is_array(session('errors'))) : ?>
              <?php foreach (session('errors') as $error) : ?>
                <span><?= $error ?></span><br>
              <?php endforeach ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php else : ?>
              <span><?= session('errors') ?></span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php endif ?>
          </div>
        <?php endif ?>
      </div>
    <?php endif ?>

    <?php if (session('message') !== null) : ?>
      <div class="mt-3">
        <div class="alert alert-success alert-dismissible fade show rounded-0 small" role="alert">
          <span><?= session('message') ?></span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    <?php endif ?>

    <div class="card bg-light rounded-0 mt-3">
      <form class="card-body mx-1" action="<?= url_to('login') ?>" method="POST">
        <?= csrf_field() ?>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label small">Email</label>
          <input type="email" name="email" class="form-control form-control-sm rounded-0" id="email" placeholder="Enter Email" value="<?= old('email') ?? '' ?>" autofocus required>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label small">Password</label>
          <input type="password" name="password" class="form-control form-control-sm rounded-0" id="password" placeholder="Enter Password" required>
        </div>

        <!-- Remember me -->
        <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
          <div class="form-check mb-3">
            <input class="form-check-input rounded-0" name="remember" id="remember" type="checkbox" <?php if (old('remember')) : ?> checked<?php endif ?>>
            <label class="form-check-label small" for="remember">Remember Me</label>
          </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-sm btn-success w-100 rounded-0">Sign in</button>
        <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
          <p class="text-center"><?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
        <?php endif ?>
      </form>
    </div>
    <?php if (setting('Auth.allowRegistration')) : ?>
      <div class="card rounded-0 my-3">
        <div class="card-body">
          <div class="small text-center"><a class="link-success fw-medium text-decoration-none" href="<?= url_to('register') ?>">Create an Account</a></div>
        </div>
      </div>
    <?php endif ?>
    <div class="text-center my-4">
      <small>Made with <span class="small pulse d-inline-block">&#10084;</span> by <a class="text-decoration-none fw-bold" href="https://instagram.com/rndio_">RND</a> <br>Copyright © <?= date('Y') ?></small>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<style>
  .pulse {
    animation: pulse .2s infinite ease alternate;
  }

  @keyframes pulse {
    from {
      transform: scale(0.8);
    }

    to {
      transform: scale(1);
    }
  }
</style>
<?= $this->endSection() ?>