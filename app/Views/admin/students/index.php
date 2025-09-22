<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Daftar Mahasiswa</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <a href="/admin/students/create" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $s): ?>
                    <tr>
                        <td><?= esc($s['id']) ?></td>
                        <td><?= esc($s['NIM']) ?></td>
                        <td><?= esc($s['nama']) ?></td>
                        <td><?= esc($s['umur']) ?></td>
                        <td>
                            <a href="/admin/students/edit/<?= esc($s['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/admin/students/delete/<?= esc($s['id']) ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin?')">Delete</a>
                            <a href="/admin/students/detail/<?= esc($s['id']) ?>" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>