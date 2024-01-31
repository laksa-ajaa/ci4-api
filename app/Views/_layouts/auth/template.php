<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $this->renderSection('title') ?></title>
  <meta name="robots" content="noindex,nofollow">
  <link rel="shortcut icon" href="https://www.rndio.my.id/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url(<?= base_url('assets/img/pattern.svg') ?>);
      background-repeat: repeat;
    }

    img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
      display: none;
    }

    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
      background-color: #fff
    }

    ::-webkit-scrollbar-thumb {
      background-color: #c1c1c1
    }

    ::-webkit-scrollbar-thumb:hover {
      background-color: #a8a8a8
    }
  </style>
  <?= $this->renderSection('pageStyles') ?>
</head>

<body>
  <main role="main" class="container">
    <?= $this->renderSection('content') ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <?= $this->renderSection('pageScripts') ?>
</body>

</html>