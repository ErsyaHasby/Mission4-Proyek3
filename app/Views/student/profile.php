<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Data Diri Mahasiswa</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (!empty($student)): ?>
            <p><strong>NIM:</strong> <?= esc($student['NIM']) ?></p>
            <p><strong>Nama:</strong> <?= esc($student['nama']) ?></p>
            <p><strong>Umur:</strong> <?= esc($student['umur']) ?></p>
        <?php else: ?>
            <p>Data mahasiswa tidak ditemukan.</p>
        <?php endif; ?>

        <a href="/student/dashboard" class="btn btn-primary mt-3">Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>