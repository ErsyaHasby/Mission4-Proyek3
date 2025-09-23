<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #FFFFFF;">
    <div class="card p-4" style="width: 100%; max-width: 400px;">
        <div class="card-header text-center">
            <h4>Login Sistem Akademik</h4>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <form method="post" action="/login">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>