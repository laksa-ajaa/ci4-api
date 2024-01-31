<?= $this->extend('_layouts/admin/template'); ?>

<?= $this->section('header'); ?>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard/project') ?>">Project</a></li>
    <li class="breadcrumb-item active">Category</li>
  </ol>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card card-body">
  <div class="d-flex flex-wrap align-items-center justify-content-between">
    <div class="d-inline-flex gap-1 h5 mb-0">
      <i class="ri-contacts-book-2-line"></i>
      <span class="fw-bold">Project Category</span>
    </div>

    <button type="button" id="create-action" class="btn btn-sm btn-primary rounded-0">
      <span>Add Category</span>
      <i class="ri-add-line"></i>
    </button>
  </div>
</div>

<div class="card card-body mt-3">
  <div class="table-responsive">
    <table id="table" class="table table-bordered small mb-0">
      <thead>
        <tr class="table-light">
          <th>No</th>
          <th>Category Name</th>
          <th>Total Project</th>
          <th>Date modified</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($categories == null) : ?>
          <tr>
            <td colspan="4" class="text-center">No data available</td>
          </tr>
        <?php endif ?>
        <?php foreach ($categories as $key => $category) : ?>
          <tr>
            <th scope="row"><?= $key + 1 ?></th>
            <td><?= $category['name'] ?></td>
            <td><?= $category['project_count'] ?></td>
            <td><?= \Carbon\Carbon::parse($category['updated_at'])->tz('Asia/Jakarta')->format('d M Y h:i A') ?></td>
            <td class="text-center align-middle">
              <div class="d-flex gap-1">
                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn text-primary btn-ghost btn-sm edit-action" data-category="<?= $category['name'] ?>" data-id="<?= $category['id'] ?>">
                  <i class="ri-edit-box-line"></i>
                </button>
                <form action="<?= base_url('dashboard/project/category/' . $category['id']) ?>" method="POST" class="delete-action" data-category="<?= $category['name'] ?>">
                  <?= csrf_field() ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn text-danger btn-ghost btn-sm">
                    <i class="ri-delete-bin-line"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modal" data-bs-backdrop="static" tabindex="-1">
  <form id="formCategory" action="" method="POST" class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-1">
      <div class="modal-header">
        <h1 class="modal-title h6 fw-bold" id="form-title">Add New Category</h1>
        <button type="button" class="btn-close rounded-1 small" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
          <label for="name" class="form-label small">Category Name</label>
          <input name="name" id="name" placeholder="Name" type="text" class="form-control form-control-sm rounded-0 <?= isset(session('validation')['name']) ? 'is-invalid' : '' ?>" required>
          <?php if (isset(session('validation')['name'])) : ?><div class="invalid-feedback"><?= session('validation')['name'] ?></div><?php endif ?>
        </div>
      </div>
      <div class="modal-footer">
        <?= csrf_field() ?>
        <input id="form-method" type='hidden' name='_method' value='POST'>
        <button id="form-submit" type="submit" class="btn btn-sm rounded-0 btn-success">Save Category</button>
      </div>
    </div>
  </form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const modalEl = document.getElementById('modal');
    const modal = new bootstrap.Modal(modalEl);
    const form = document.getElementById('formCategory');

    const createButton = document.getElementById('create-action');
    const editButtons = document.querySelectorAll('button.edit-action');
    const deleteForms = document.querySelectorAll('form.delete-action');

    createButton.addEventListener('click', () => {
      form.reset();
      document.getElementById('form-method').value = 'POST';
      document.getElementById('form-title').innerHTML = 'Add New Category';
      document.getElementById('form-submit').innerHTML = 'Add Category' + '<i class="ms-1 ri-add-line"></i>';
      form.setAttribute('action', '<?= base_url('dashboard/project/category') ?>');
      modal.show();
    });

    editButtons.forEach((button) => {
      button.addEventListener('click', () => {
        form.reset();
        document.getElementById('form-method').value = 'PUT';
        document.getElementById('form-title').innerHTML = `Edit Category (${button.dataset.category})`;
        document.getElementById('form-submit').innerHTML = 'Edit Category' + '<i class="ms-1 ri-edit-box-line"></i>';
        form.name.value = button.dataset.category;
        form.setAttribute('action', `<?= base_url('dashboard/project/category/edit') ?>/${button.dataset.id}`);
        modal.show();
      });
    });

    deleteForms.forEach((form) => {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const confirm = window.confirm(`Are u sure want to delete (${form.dataset.category}) category ?`);
        if (confirm) {
          form.submit();
        }
      });
    });

  });
</script>
<?= $this->endSection(); ?>