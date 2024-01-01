<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title><?= $title ?? '' ?></title>
  <meta name="robots" content="noindex,nofollow" />
  <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon" />
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
