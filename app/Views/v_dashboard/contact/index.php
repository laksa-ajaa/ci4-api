<?= $this->extend('_layouts/admin/template'); ?>
<?= $this->section('content'); ?>
<div class="table-responsive">
<table id="contactTable" class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Message</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($contacts as $key => $contact) : ?>
    <tr>
      <th scope="row"><?= $key+1 ?></th>
      <td><?= $contact['name'] ?? '-' ?></td>
      <td><?= $contact['email'] ?? '-' ?></td>
      <td><?= $contact['message'] ?></td>
      <td>
        <div class="d-flex gap-1">
          <a title="Detail" href="<?= current_url() . '/detail/' . $contact['id'] ?>" class="btn btn-secondary btn-sm rounded-0">
            <i class="ri-eye-line"></i>
          </a>
          <form class="d-inline" action="<?=current_url() . '/' . $contact['id']?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" title="Delete" class="btn btn-danger btn-sm rounded-0"><i class="ri-delete-bin-2-line"></i></button>
          </form>
        </div>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
  new simpleDatatables.DataTable("#contactTable", {
	// searchable: false,
	// fixedHeight: true,
})
</script>
<?= $this->endSection(); ?>