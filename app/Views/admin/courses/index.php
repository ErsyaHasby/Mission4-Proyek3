<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Daftar Courses</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <a href="/admin/courses/create" class="btn btn-primary mb-3">Tambah Course</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $c): ?>
                    <tr>
                        <td><?= esc($c['id']) ?></td>
                        <td><?= esc($c['title']) ?></td>
                        <td><?= esc($c['description']) ?></td>
                        <td>
                            <a href="/admin/courses/edit/<?= esc($c['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/admin/courses/delete/<?= esc($c['id']) ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin hapus?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>