<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Detail Mahasiswa</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (!empty($student)): ?>
            <p><strong>NIM:</strong> <?= esc($student['NIM']) ?></p>
            <p><strong>Nama:</strong> <?= esc($student['nama']) ?></p>
            <p><strong>Umur:</strong> <?= esc($student['umur']) ?></p>

            <h5>Courses yang Diambil:</h5>
            <?php if (!empty($courses)): ?>
                <ul class="list-group">
                    <?php foreach ($courses as $course): ?>
                        <li class="list-group-item"><?= esc($course['title']) ?> - <?= esc($course['description']) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Belum mengambil course.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Data mahasiswa tidak ditemukan.</p>
        <?php endif; ?>

        <a href="/admin/students" class="btn btn-primary mt-3">Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>