<?= $this->extend('_layouts/admin/template'); ?>
<?= $this->section('content'); ?>
<div class="table-responsive">
  <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user) : ?>
      <tr>
        <th scope="row"><?= $user['userid'] ?></th>
        <td><?= $user['fullname'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['role'] ?></td>
        <td>
          <a aria-label="Detail" class="btn btn-ghost btn-circle" href="<?=current_url().'/detail/'.$user['userid']?>"><i class="ri-eye-line"></i></a>
          <a aria-label="Edit" class="btn btn-ghost btn-circle" href="<?=current_url().'/edit/'.$user['userid']?>"><i class="ri-edit-box-line"></i></a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="position-fixed bottom-0 end-0 m-4">
  <a href="<?= route_to('Admin\UserManagement::create') ?>" class="btn btn-primary btn-circle"><i class="ri-add-line"></i></a>
</div>
<?= $this->endSection(); ?>
