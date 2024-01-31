<?= $this->extend('_layouts/admin/template'); ?>

<?= $this->section('header'); ?>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Contact</li>
  </ol>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card card-body">
  <div class="d-inline-flex gap-1 mb-0 h5">
    <i class="ri-contacts-book-2-line"></i>
    <span class="fw-bold">Contact Response</span>
  </div>
</div>

<div class="card card-body mt-3">
  <div class="table-responsive">
    <table class="table table-bordered small">
      <thead>
        <tr class="table-light">
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Timestamp</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($contacts as $key => $contact) : ?>
          <tr>
            <th scope="row"><?= $key + 1 ?></th>
            <td><?= $contact['name'] ?? 'Anonymous' ?></td>
            <td><?= $contact['email'] ?? '-' ?></td>
            <td><?= \Carbon\Carbon::parse($contact['created_at'])->tz('Asia/Jakarta')->format('d M Y h:i:s A') ?></td>
            <td>
              <div class="d-flex gap-1">
                <button data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="btn text-primary btn-ghost btn-sm view-action" data-id="<?= $contact['id'] ?>">
                  <i class="ri-eye-line"></i>
                </button>
                <form class="d-inline delete-action" action="<?= current_url() . '/' . $contact['id'] ?>" method="POST">
                  <?= csrf_field() ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn text-danger btn-ghost btn-sm"><i class="ri-delete-bin-2-line"></i></button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <nav>
      <ul class="pagination">
        <?= $pager->links('contact', 'bootstrap_template') ?>
      </ul>
    </nav>
  </div>
</div>

<div class="modal fade" id="modalContact" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-start border-primary border-5" style="border:unset">
      <div class="modal-header">
        <div class="d-flex align-items-center gap-2">
          <img id="m-photo" src="" class="rounded-1" width="40" height="40">
          <div>
            <p id="m-name" class="m-0 fw-medium small"></p>
            <p id="m-timestamp" class="m-0 smaller"></p>
          </div>
        </div>
        <button type="button" class="btn-close smaller rounded-0" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body rounded-2">
        <p id="m-message" class="mb-0 small"></p>
      </div>
    </div>
  </div>
</div>

<div aria-hidden="true" class="d-flex align-items-center justify-content-center vh-100 vw-100 top-0 start-0" id="c-backdrop">
  <div aria-label="Loading..." class="spinner-border text-light" role="status" style="height: 3rem; width: 3rem;"></div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('css') ?>
<style>
  #c-backdrop {
    z-index: 1040;
    position: fixed;
    background-color: rgba(0, 0, 0, .7);
    opacity: 0;
    transition: opacity .15s linear;
    pointer-events: none
  }

  #c-backdrop.active {
    opacity: 1;
    pointer-events: unset
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('js'); ?>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const modalEl = document.getElementById('modalContact');
    const modal = new bootstrap.Modal(modalEl);
    const viewBtn = document.querySelectorAll('button.view-action');
    const deleteForm = document.querySelectorAll('form.delete-action');
    const backdrop = document.getElementById('c-backdrop');

    function loader(e) {
      document.body.style.overflow = e ? 'hidden' : '';
      e ? backdrop.classList.add("active") : backdrop.classList.remove("active");
    };

    function renderModal(data) {
      modalEl.querySelector('#m-photo').src = data.photo;
      modalEl.querySelector('#m-name').innerHTML = data.name ?? 'Anonymous';
      modalEl.querySelector('#m-timestamp').innerHTML = data.timestamp;
      data.message = data.message.replaceAll('\n', '<br>');
      modalEl.querySelector('#m-message').innerHTML = data.message;
      modal.show();
    }

    function showModal(id) {
      loader(true);
      fetch(`<?= base_url('dashboard/contact') ?>/${id}`)
        .then(response => response.json())
        .then(data => {
          loader(false);
          renderModal(data.data)
        })
        .catch(error => {
          loader(false);
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data not found!'
          })
        });
    }

    viewBtn.forEach(btn => {
      btn.addEventListener('click', () => showModal(btn.dataset.id))
    });
    deleteForm.forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire(swalOptions)
          .then((result) => {
            if (result.isConfirmed) {
              e.target.submit()
            }
          });
      });
    });
  });
</script>
<?= $this->endSection(); ?>