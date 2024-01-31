<?= $this->extend('_layouts/admin/template'); ?>

<?= $this->section('header'); ?>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item">Project</li>
    <li class="breadcrumb-item active">Techstacks</li>
  </ol>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card card-body">
  <div class="d-flex flex-wrap align-items-center justify-content-between">
    <div class="d-inline-flex gap-1 mb-0 h5">
      <i class="ri-contacts-book-2-line"></i>
      <span class="fw-bold">Project Techstacks</span>
    </div>

    <button id="create-action" class="btn btn-sm btn-primary rounded-0">
      <span>Add Techstack</span>
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
          <th>Techstack</th>
          <th>Total Project</th>
          <th>Date modified</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($techstacks == null) : ?>
          <tr>
            <td colspan="4" class="text-center">No data available</td>
          </tr>
        <?php endif ?>
        <?php foreach ($techstacks as $key => $techstack) : ?>
          <tr>
            <th><?= $key + 1 ?></th>
            <td>
              <div class="d-flex gap-2 align-items-center">
                <div id="img-preview" style="height: 30px;width: 30px;">
                  <img src=" <?= $techstack['image'] ? base_url("assets/img/techstacks/{$techstack['image']}") : base_url("assets/img/noimage.webp") ?>">
                </div>
                <span class="fw-medium"><?= $techstack['name'] ?></span>
              </div>
            </td>
            <td><?= $techstack['count_project'] ?></td>
            <td><?= \Carbon\Carbon::parse($techstack['updated_at'])->tz('Asia/Jakarta')->format('d M Y h:i A') ?></td>
            <td>
              <div class="d-flex gap-1">
                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-id="<?= $techstack['id'] ?>" data-name="<?= $techstack['name'] ?>" data-image="<?= base_url("assets/img/techstacks/{$techstack['image']}") ?>" class="btn text-primary btn-ghost btn-sm edit-action">
                  <i class="ri-edit-box-line"></i>
                </button>
                <form action="<?= base_url('dashboard/project/techstack/' . $techstack['id']) ?>" method="POST" class="delete-action" data-techstack="<?= $techstack['name'] ?>">
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
<div class="modal fade" id="modalTechstack" data-bs-backdrop="static">
  <form id="formCategory" action="" method="POST" class="modal-dialog modal-dialog-centered" enctype="multipart/form-data">
    <div class="modal-content rounded-1">
      <div class="modal-header">
        <h1 class="modal-title h6 fw-bold" id="form-title">Add New Techstack</h1>
        <button type="button" class="btn-close rounded-1 small" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col-12">
            <label for="name" class="form-label small">Techstack Name</label>
            <input name="name" id="name" placeholder="Name" type="text" class="form-control form-control-sm rounded-0">
          </div>
          <div class="col-12 col-md-10">
            <label for="image" class="form-label small">Techstack Image</label>
            <input name="image" id="image" type="file" class="form-control form-control-sm rounded-0">
          </div>
          <div class="col-12 col-md-2">
            <div id="img-preview" class="border border-1 p-1" style="height: 70px;width: 70px;">
              <img id="img-project" id="image-preview" src="<?= base_url('assets/img/noimage.webp') ?>" alt="Preview Image">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <?= csrf_field() ?>
        <input id="form-method" type='hidden' name='_method' value='POST'>
        <button id="form-submit" type="submit" class="btn btn-sm rounded-0 btn-success">Add Techstack</button>
      </div>
    </div>
  </form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('css'); ?>
<style>
  #img-preview {
    max-height: 100%;
    height: 150px;
    overflow: hidden;
    position: relative;
  }

  #img-preview img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }
</style>
<?= $this->endSection(); ?>

<?= $this->section('js');  ?>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const modalEl = document.getElementById('modalTechstack');
    const modal = new bootstrap.Modal(modalEl);
    const form = document.getElementById('formCategory');

    form.image.addEventListener('change', (e) => {
      const file = e.target.files[0];
      const reader = new FileReader();
      reader.onload = (e) => {
        document.getElementById('img-project').src = e.target.result;
      }
      reader.readAsDataURL(file);
    });

    const createButton = document.getElementById('create-action');
    const editButtons = document.querySelectorAll('button.edit-action');
    const deleteForms = document.querySelectorAll('form.delete-action');

    createButton.addEventListener('click', () => {
      form.reset();
      document.getElementById('img-project').src = '<?= base_url('assets/img/noimage.webp') ?>';
      document.getElementById('form-method').value = 'POST';
      document.getElementById('form-title').innerHTML = 'Add New Techstack';
      document.getElementById('form-submit').innerHTML = 'Add Techstack' + '<i class="ms-1 ri-add-line"></i>';
      form.setAttribute('action', '<?= base_url('dashboard/project/techstack') ?>');
      modal.show();
    });


    editButtons.forEach(button => {
      button.addEventListener('click', () => {
        form.reset();
        form.name.value = button.dataset.name;
        document.getElementById('img-project').src = button.dataset.image;
        document.getElementById('form-method').value = 'PUT';
        document.getElementById('form-title').innerHTML = `Edit Techstack (${button.dataset.name})`;
        document.getElementById('form-submit').innerHTML = "Edit Techstack <i class='ms-1 ri-edit-box-line'></i>";
        form.setAttribute('action', `<?= base_url('dashboard/project/techstack') ?>/edit/${button.dataset.id}`);
        modal.show();
      });
    });

    deleteForms.forEach(form => {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const confirm = window.confirm(`Are u sure want to delete (${form.dataset.techstack}) techstack ?`);
        if (confirm) {
          form.submit();
        }
      });
    });
  });
</script>
<?= $this->endSection(); ?>