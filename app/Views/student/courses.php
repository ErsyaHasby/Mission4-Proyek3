<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Daftar Courses</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <h5 class="mt-4">Courses yang Tersedia</h5>
        <?php if (!empty($allCourses)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allCourses as $course): ?>
                        <tr>
                            <td><?= esc($course['title']) ?></td>
                            <td><?= esc($course['description']) ?></td>
                            <td>
                                <a href="/student/enroll/<?= esc($course['id']) ?>" class="btn btn-sm btn-primary">Enroll</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada course tersedia.</p>
        <?php endif; ?>

        <h5 class="mt-5">Courses yang Sudah Diambil</h5>
        <?php if (!empty($takenCourses)): ?>
            <ul class="list-group">
                <?php foreach ($takenCourses as $tc): ?>
                    <li class="list-group-item"><?= esc($tc['title']) ?> - <?= esc($tc['description']) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Belum ada course yang diambil.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>