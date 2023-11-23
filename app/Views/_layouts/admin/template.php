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
    <div id="layoutSidenav_nav" class="shadow-sm"><?= $this->include("_layouts/admin/sidebar.php") ?></div>
    <div id="layoutSidenav_content">
      <main>
        <div class="d-flex bg-white p-4 mb-4 shadow-sm">
          <h3 class="fw-bold m-0"><?=$title?></h3>
        </div>
        <div class="container-fluid px-4">
          <?= $this->renderSection('content') ?>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="text-muted small">Copyright &copy; <?=date("Y")?> - <?= '' // APP_NAME ?></div>
        </div>
      </footer>
    </div>
  </div>
  <?= $this->include("_layouts/admin/js") ?>
  <?= $this->renderSection('js') ?>
</body>

</html>
