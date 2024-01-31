<?= $this->extend('_layouts/admin/template'); ?>

<?= $this->section('content'); ?>
<div class="row g-3">
  <div class="12 col-lg-8">
    <div class="card card-body">
      <div class="d-flex gap-3 align-items-center">
        <img height="75" src="https://em-content.zobj.net/source/microsoft-teams/363/man-raising-hand-light-skin-tone_1f64b-1f3fb-200d-2642-fe0f.png" />
        <div>
          <h3 class="mb-1"><span class="fw-bold">Hello</span> <?= auth()->user()->name ?></h3>
          <p class="text-muted mb-0">Welcome to Dashboard!</p>
        </div>
      </div>
    </div>
    <div class="row g-3 mt-2">
      <?php foreach ($data as $projectTitle => $project) : ?>
        <div class="col-12 col-md-6">
          <div class="card card-body card-dashboard p-3">
            <div class="d-flex gap-3 align-items-center">
              <div class="icons"><i class="<?= $project['icon'] ?>"></i></div>
              <div class="info text-truncate">
                <div class="text-muted small mb-1"><?= $projectTitle ?></div>
                <h4 class="fw-bold mb-0 countut"><?= $project['count'] ?></h4>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
      <style>
        .card-dashboard .icons {
          width: 50px;
          height: 50px;
          border-radius: 5px;
          background-color: var(--bs-primary);
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 1.5rem;
          color: #fff;
        }
      </style>
    </div>
  </div>
  <div class="col-12 col-lg-4">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Recent Response</div>
      </div>
      <div class="card-body">
        <ul class="list-unstyled list-unstyled-border mb-0">
          <?php foreach ($recent_contacts as $key => $contact) : ?>
            <li class="d-flex align-items-center <?= $key != 0 ? 'mt-3' : '' ?>">
              <div class="flex-shrink-0">
                <img height="50" class="rounded-circle" src="<?= $contact['email'] ? "https://www.gravatar.com/avatar/" . md5($contact['email']) . "?s=100&d=mm&r=g" : 'https://www.gravatar.com/avatar/?s=100&d=mm&r=g' ?>">
              </div>
              <div class="flex-grow-1 ms-3 small">
                <h6 class="fw-bold mb-0 small"><?= $contact['name'] ?? 'Anonymous' ?></h6>
                <div class="small"><?= substr($contact['message'], 0, 100) . '...'  ?></div>
                <div class="small fw-medium"><?= \Carbon\Carbon::parse($contact['created_at'])->diffForHumans() ?></div>
              </div>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>