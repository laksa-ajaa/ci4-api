<?= $this->extend('_layouts/admin/template'); ?>

<?= $this->section('header'); ?>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Project</li>
  </ol>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card card-body">
  <div class="d-flex flex-wrap align-items-center justify-content-between">
    <div class="d-inline-flex gap-1 mb-0 h5">
      <i class="ri-contacts-book-2-line"></i>
      <span class="fw-bold">Project</span>
    </div>

    <a href="<?= base_url('dashboard/project/new') ?>" class="btn btn-sm btn-primary rounded-0">
      <span>Add Project</span>
      <i class="ri-add-line"></i>
    </a>
  </div>
</div>

<div class="card card-body mt-3">
  <div class="table-responsive">
    <table id="table" class="table table-bordered small mb-0">
      <thead>
        <tr class="table-light">
          <th>No</th>
          <th>Project Name</th>
          <th>Category</th>
          <th>Techstacks</th>
          <th>Date modified</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($projects == null) : ?>
          <tr>
            <td colspan="6" class="text-center">No data available</td>
          </tr>
        <?php endif ?>
        <?php foreach ($projects as $key => $project) : ?>
          <tr>
            <th><?= $key + 1 ?></th>
            <td><?= $project['name'] ?></td>
            <td><?= $project['category_name'] ?></td>
            <td>
              <?php
              $techstacks = explode(',', $project['techstack_name']);
              foreach ($techstacks as $techstack) : ?><span class="badge bg-primary rounded-0"><?= $techstack ?></span>
              <?php endforeach
              ?>
            </td>
            <td><?= \Carbon\Carbon::parse($project['updated_at'])->tz('Asia/Jakarta')->format('d M Y h:i A') ?></td>
            <td>
              <div class="d-flex gap-1">
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href="<?= base_url('dashboard/project/edit/' . $project['id']) ?>" class="btn text-primary btn-ghost btn-sm">
                  <i class="ri-edit-box-line"></i>
                </a>
                <form action=" <?= base_url('dashboard/project/' . $project['id']) ?>" method="POST">
                  <?= csrf_field() ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn text-danger btn-ghost btn-sm delete-action">
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

<?= $this->endSection(); ?>