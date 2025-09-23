<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h4>Selamat Datang, <?= esc(session()->get('nama') ?? 'Mahasiswa') ?>!</h4>
    </div>
    <div class="card-body">
        <p>Selamat datang di Universitas Persib Bandung.</p>
    </div>
</div>

<?= $this->endSection() ?>