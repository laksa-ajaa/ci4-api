<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title><?= isset($title) ? $title . " - " . APP_NAME : APP_NAME ?></title>
  <meta name="robots" content="noindex,nofollow" />
  <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>body{ background-image: url('assets/img/auth-pattern.svg');background-repeat: repeat; }</style>
</head>

<body>
  <?= $this->renderSection('content') ?>
</body>

</html>
