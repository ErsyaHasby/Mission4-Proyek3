<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Dashboard Admin</h4>
    </div>
    <div class="card-body">
        <p>Selamat datang, <b>Admin</b>!</p>
        <div class="list-group">
            <a href="/admin/courses" class="list-group-item list-group-item-action">Kelola Courses</a>
            <a href="/admin/students" class="list-group-item list-group-item-action">Kelola Mahasiswa</a>
            <a href="/logout" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>