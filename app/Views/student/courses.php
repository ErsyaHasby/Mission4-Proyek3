<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h4>Daftar Courses</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <h5 class="mt-4">Pilih Courses untuk Enroll</h5>
        <form id="enroll-form" method="post" action="/student/enroll_multiple" class="needs-validation" novalidate>
            <div id="course-list" class="mb-3">
                <?php if (!empty($allCourses)): ?>
                    <?php foreach ($allCourses as $course): ?>
                        <?php $isEnrolled = false; ?>
                        <?php foreach ($takenCourses as $tc): ?>
                            <?php if ($tc['id'] == $course['id']): $isEnrolled = true; break; endif; ?>
                        <?php endforeach; ?>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input course-checkbox" name="courses[]" value="<?= $course['id'] ?>" id="course-<?= $course['id'] ?>" <?= $isEnrolled ? 'disabled' : '' ?>>
                            <label class="form-check-label" for="course-<?= $course['id'] ?>">
                                <?= esc($course['title']) ?> (SKS: <?= esc($course['sks']) ?>) - <?= esc($course['description']) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada course tersedia.</p>
                <?php endif; ?>
            </div>
            <p>Total SKS: <span id="total-sks">0</span></p>
            <button type="submit" class="btn btn-primary">Submit</button>
            <div id="error-message" class="text-danger mt-2" style="display: none;"></div>
            <div id="async-notification" class="mt-3" style="display: none;"></div>
        </form>

        <h5 class="mt-5">Courses yang Sudah Diambil</h5>
        <?php if (!empty($takenCourses)): ?>
            <ul class="list-group">
                <?php foreach ($takenCourses as $tc): ?>
                    <li class="list-group-item">
                        <?= esc($tc['title']) ?> - <?= esc($tc['description']) ?> (SKS: <?= esc($tc['sks']) ?>)
                        <a href="/student/delete_enroll/<?= esc($tc['enrollment_id']) ?>" class="btn btn-sm btn-danger float-end delete-btn" data-id="<?= $tc['enrollment_id'] ?>" data-title="<?= $tc['title'] ?>" data-sks="<?= $tc['sks'] ?>">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Belum ada course yang diambil.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>