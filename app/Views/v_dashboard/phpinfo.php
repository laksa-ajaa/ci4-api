<?= $this->extend('_layouts/admin/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
  <iframe src="<?= base_url("dashboard/phpinfo/iframe") ?>" style="overflow: hidden;"  allowtransparency="true" width="100%" class="vh-100"></iframe>
</div>
<?= $this->endSection(); ?>