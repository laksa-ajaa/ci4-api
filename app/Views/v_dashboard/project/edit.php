<?= $this->extend('_layouts/admin/template'); ?>

<?= $this->section('header'); ?>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard/project') ?>">Project</a></li>
    <li class="breadcrumb-item active">Edit: <?= $project['name'] ?></li>
  </ol>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card card-body rounded-0">

  <div class="d-inline-flex gap-1 mb-4 h5">
    <i class="ri-contacts-book-2-line"></i>
    <span class="fw-bold">Add Project</span>
  </div>

  <form id="form" class="row" action="<?= base_url("dashboard/project/edit/{$project['id']}") ?>" method="POST" enctype="multipart/form-data">
    <div class="col-12 col-md-6">
      <div class="mb-3">
        <label for="name" class="form-label small required">Project Name</label>
        <input type="text" class="form-control form-control-sm rounded-0 <?= isset(session('validation')['name']) ? 'is-invalid' : '' ?>" name="name" id="name" value="<?= old('name') ?? $project['name'] ?>">
        <?php if (isset(session('validation')['name'])) : ?><div class="invalid-feedback"><?= session('validation')['name'] ?></div><?php endif ?>
      </div>
      <div class="mb-3">
        <label for="year" class="form-label small required">Project Category</label>
        <select class="form-select form-select-sm rounded-0 <?= isset(session('validation')['category_id']) ? 'is-invalid' : '' ?>" name="category_id">
          <option disabled selected>Select Category</option>
          <?php foreach ($project_categories as $project_category) : ?>
            <option <?= (old('category_id') ?? $project['category_id']) == $project_category['id'] ? 'selected' : '' ?> value="<?= $project_category['id'] ?>"><?= $project_category['name'] ?></option>
          <?php endforeach ?>
        </select>
        <?php if (isset(session('validation')['category_id'])) : ?>
          <div class="invalid-feedback"><?= session('validation')['category_id'] ?></div>
        <?php endif ?>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label small required">Project Description</label>
        <textarea class="form-control form-control-sm rounded-0 <?= isset(session('validation')['description']) ? 'is-invalid' : '' ?>" name="description" id="description" rows="4"><?= old('description') ?? $project['description'] ?></textarea>
        <?php if (isset(session('validation')['description'])) : ?>
          <div class="invalid-feedback"><?= session('validation')['description'] ?></div>
        <?php endif ?>
      </div>
      <div class="mb-3">
        <label for="techstack" class="form-label small required">Project Techstack</label>
        <select name="techstack[]" id="techstack" class="form-select form-select-sm rounded-0 <?= isset(session('validation')['techstack']) ? 'is-invalid' : '' ?>" multiple>
          <?php foreach ($techstacks as $techstack) : ?>
            <?php if (old('techstack') && is_array(old('techstack'))) : ?>
              <option <?= in_array($techstack['id'], (array) old('techstack')) ? 'selected' : '' ?> value="<?= $techstack['id'] ?>"><?= $techstack['name'] ?></option>
            <?php else : ?>
              <option <?= in_array($techstack['id'], ((array) explode(',', $project['techstacks_id']))) ? 'selected' : '' ?> value="<?= $techstack['id'] ?>"><?= $techstack['name'] ?></option>
            <?php endif ?>
          <?php endforeach ?>
        </select>
        <?php if (isset(session('validation')['techstack'])) : ?>
          <div class="invalid-feedback"><?= session('validation')['techstack'] ?></div>
        <?php endif ?>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-6">
          <label for="link" class="form-label small">Project Link</label>
          <input type="url" placeholder="https://example.com" class="form-control form-control-sm rounded-0 <?= isset(session('validation')['link']) ? 'is-invalid' : '' ?>" name="link" id="link" value="<?= old('link') ?? $project['link'] ?>">
          <?php if (isset(session('validation')['link'])) : ?>
            <div class="invalid-feedback"><?= session('validation')['link'] ?></div>
          <?php endif ?>
        </div>
        <div class="col-6">
          <label for="link_github" class="form-label small">Project Link Github</label>
          <input type="url" placeholder="https://github.com/example" class="form-control form-control-sm rounded-0 <?= isset(session('validation')['link_github']) ? 'is-invalid' : '' ?>" name="link_github" id="link_github" value="<?= old('link_github') ?? $project['link_github'] ?>">
          <?php if (isset(session('validation')['link_github'])) : ?>
            <div class="invalid-feedback"><?= session('validation')['link_github'] ?></div>
          <?php endif ?>
        </div>
      </div>
      <div class="form-check">
        <input class="form-check-input rounded-0" type="checkbox" name="is_featured" id="is_featured" <?= $project['is_featured'] == 1 ? 'checked' : '' ?>>
        <label class="form-check-label small d-inline-flex align-items-center gap-1" for="is_featured">Featured Project <small>&#11088;</small></label>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="mb-3">
        <label for="photo" class="form-label small">Project Image</label>
        <input type="file" id="photo" name="photo" class="form-control form-control-sm rounded-0 <?= isset(session('validation')['photo']) ? 'is-invalid' : '' ?>" onchange="previewImage(event)">
        <?php if (isset(session('validation')['photo'])) : ?>
          <div class="invalid-feedback"><?= session('validation')['photo'] ?></div>
        <?php endif ?>
      </div>
      <div class="mb-3" id="image_preview_container">
        <label class="small">Preview Image</label>
        <div id="image_preview" style="position: relative; width: 100%; height: 400px; overflow: hidden; text-align: center;">
          <img src="<?= old('photo') ?? base_url('assets/img/project/' . $project['image']) ?>" id="preview_image" style="max-width: 100%; max-height: 100%; display: inline-block; vertical-align: middle;">
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6 text-end">
      <?= csrf_field() ?>
      <input type="hidden" name="_method" value="PUT">
      <button type="submit" class="btn btn-sm btn-success rounded-0 mb-3">Save <i class="ri-save-line"></i></button>
    </div>
  </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('css'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  const form = document.getElementById('form');

  $(form.category_id).select2();
  $(form.techstack).select2();

  function previewImage(event) {
    var reader = new FileReader();
    var imageField = document.getElementById("preview_image");
    var imageContainer = document.getElementById("image_preview_container");
    var imagePreview = document.getElementById("image_preview");

    imageContainer.style.display = "block";
    imagePreview.style.display = "block";

    reader.onload = function() {
      imageField.src = reader.result;
    };

    reader.readAsDataURL(event.target.files[0]);
  };
</script>
<?= $this->endSection(); ?>