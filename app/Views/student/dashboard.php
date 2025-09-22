```php
<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Dashboard Mahasiswa</h4>
    </div>
    <div class="card-body">
        <p>Selamat datang, <b><?= esc(session()->get('nama') ?? 'Mahasiswa') ?></b>!</p>
        <div class="list-group">
            <a href="/student/courses" class="list-group-item list-group-item-action">Lihat Courses</a>
            <a href="/student/profile" class="list-group-item list-group-item-action">Lihat Data Diri</a>
            <a href="/logout" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>