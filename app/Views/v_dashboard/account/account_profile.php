<?= $this->extend('_layouts/admin/template') ?>
<?= $this->section('content') ?>

<div class="row">
  <div class="col-xl-4">
    <div class="card mb-4 mb-xl-0">
      <div class="card-header">Profile Picture</div>
      <div class="card-body text-center">
      <picture id="profilePicture" class="position-relative">
        <img class="rounded-circle mb-2" height="120" width="120" src="<?= base_url("assets/img/pp/".user()->user_image) ?>" alt="<?= user()->fullname ?>">
        <div class="dropdown">
          <button class="btn btn-sm btn-dark btn-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Edit"><i class="ri-camera-fill"></i></button>
          <ul class="dropdown-menu">
            <li><label for="formCropper" class="dropdown-item" role="button"><i class="ri-add-line me-2"></i>Upload Photo</label></li>
            <li><a class="dropdown-item text-danger" href="#"><i class="ri-delete-bin-line me-2"></i>Remove Photo</a></li>
            <input class="form-control d-none" type="file" accept="image/*" data-maxsize="1" id="formCropper"/>
          </ul>
        </div>
      </picture>
      <div class="small fst-italic text-muted">Image Format<br/>no larger than 1 MB</div>
      </div>
    </div>
  </div>
  <div class="col-xl-8">
    <!-- Account details card-->
    <form class="card mb-4" action="<?= route_to('Admin\AccountManagement::save') ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
      <div class="card-header">Account Details</div>
      <div class="card-body">
        <form>
          <div class="mb-3">
            <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="<?= user()->username ?>" required/>
          </div>
          <div class="row gx-3 mb-3">
            <div class="col-md-6">
              <label class="small mb-1" for="inputName">Name</label>
              <input class="form-control" id="inputName" type="text" placeholder="Enter your full name" value="<?= user()->fullname ?>" required/>
            </div>
            <div class="col-md-6">
            <label class="small mb-1" for="inputEmailAddress">Email address</label>
            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?= user()->email ?>" required readonly disabled/>
            </div>
          </div>
          <div class="mb-3">
            <label class="small mb-1" for="inputBio">Bio</label>
            <textarea class="form-control" id="inputBio" placeholder="Tell about yourself" rows="4" value="<?= user()->username ?>"></textarea>
          </div>
          <button class="btn btn-primary rounded-0" type="button">Save changes</button>
        </form>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modalCropper" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6">Crop your new profile picture</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="img-cropper-container">
          <img id="img-cropper" src=""/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm w-100">Set new profile picture</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  const formCropper = document.getElementById('formCropper');
  const modalCropper = new bootstrap.Modal(document.getElementById('modalCropper'));
  const buttonCropper = document.querySelector('#modalCropper .modal-footer>button');
  const imgCropper = document.getElementById('img-cropper');

  // Init Cropper
  const cropper = new Cropper(imgCropper, {
    autoCropArea: 0.5,
    aspectRatio: 1,
    viewMode: 1,
    responsive: true,
    preview: '.img-preview',
    zoomable:false,
    ready: function () {
      
    },
    // crop: function() {cropper.destroy()}
  });

  formCropper.addEventListener('change', function(r) {
    const maxSizeInBytes = parseFloat(r.target.getAttribute('data-maxsize')) * 1024 * 1024;
    if (r.target.files[0].size > maxSizeInBytes) {alert('File size exceeds the maximum size');return false;}
    const reader = new FileReader();
    reader.onload = function(e) {
      imgCropper.src = e.target.result;
      modalCropper.show();
      setTimeout(function() {cropper.replace(e.target.result)}, 500);
    }
    reader.readAsDataURL(this.files[0]);
  });

  buttonCropper.addEventListener('click', function() {
    cropper.getCroppedCanvas({width: 500,height: 500})
    .toBlob(function(blob) {
      console.log(blob);

      // download blob
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'cropped.jpg';
      a.click();
      a.remove();
      URL.revokeObjectURL(url);

      // upload blob
      fetch('<?= route_to('Admin\AccountManagement::save') ?>', {
        msethod: 'POST',
        body: blob,
      }).then(function() {
        console.log('Upload success');
      }).catch(function() {
        console.log('Upload error');
      }).finally(function() {
        console.log('Upload complete');
      });
    })
  })
  </script>

<?= $this->endSection()?>