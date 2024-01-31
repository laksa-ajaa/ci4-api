<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title><?= $title ?? '' ?></title>
  <meta name="robots" content="noindex,nofollow" />
  <link rel="shortcut icon" href="https://www.rndio.my.id/favicon.ico" type="image/x-icon" />
  <?= $this->include("_layouts/admin/css") ?>
  <?= $this->renderSection('css') ?>
</head>

<body class="sb-nav-fixed">
  <?= $this->include("_layouts/admin/navbar") ?>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav"><?= $this->include("_layouts/admin/sidebar.php") ?></div>
    <div id="layoutSidenav_content">
      <main id="content">
        <header class="border-bottom bg-body mb-3">
          <div class="container-fluid px-4">
            <div class="content d-flex align-items-center justify-content-between py-2">
              <?= $this->renderSection('header') ?>
            </div>
          </div>
        </header>
        <div class="container-fluid">
          <?php if (session()->getFlashdata('success')) : ?>
            <?php if (is_array(session()->getFlashdata('success'))) : ?>
              <?php foreach (session()->getFlashdata('success') as $success) : ?>
                <div class="alert alert-success alert-dismissible fade show small rounded-0" role="alert">
                  <strong>Success!</strong> <?= esc($success) ?>
                  <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endforeach ?>
            <?php else : ?>
              <div class="alert alert-success alert-dismissible fade show small rounded-0" role="alert">
                <strong>Success!</strong> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif ?>
          <?php endif ?>

          <?php if (session()->getFlashdata('error')) : ?>
            <?php if (is_array(session()->getFlashdata('error'))) : ?>
              <?php foreach (session()->getFlashdata('error') as $error) : ?>
                <div class="alert alert-danger alert-dismissible fade show small rounded-0" role="alert">
                  <strong>Error!</strong> <?= esc($error) ?>
                  <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endforeach ?>
            <?php else : ?>
              <div class="alert alert-danger alert-dismissible fade show small rounded-0" role="alert">
                <strong>Error!</strong> <?= esc(session()->getFlashdata('error')) ?>
                <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif ?>
          <?php endif ?>
          <?= $this->renderSection('content') ?>
        </div>
      </main>
      <footer id="footer-content">
        <p class="text-muted small m-0">Copyright &copy; <?= date('Y') ?> RND</p>
      </footer>
    </div>
  </div>
  <?= $this->include("_layouts/admin/js") ?>
  <?= $this->renderSection('js') ?>
</body>

</html>