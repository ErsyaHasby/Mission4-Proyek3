<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Dashboard Admin</h4>
    </div>
    <div class="card-body">
        <p>Selamat datang, <b>Admin</b>!</p>
        <div class="list-group">
            <a href="/admin/manage_students" class="list-group-item list-group-item-action">Kelola Mahasiswa</a>
            <a href="/admin/manage_courses" class="list-group-item list-group-item-action">Kelola Courses</a>
            <a href="#" class="list-group-item list-group-item-action" id="view-student-list">Lihat Daftar Mahasiswa</a>
            <a href="/logout" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>

        <!-- Tempat untuk daftar mahasiswa (akan diisi dengan JavaScript) -->
        <div id="mahasiswa-list" class="mt-3" style="display: none;"></div>
    </div>
</div>

<?= $this->endSection() ?>