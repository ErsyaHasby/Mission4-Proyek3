<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Tambah Mahasiswa</h4>
    </div>
    <div class="card-body">
        <form method="post" action="/admin/students/store">
            <div class="mb-3">
                <label for="NIM" class="form-label">NIM</label>
                <input type="text" name="NIM" id="NIM" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="number" name="umur" id="umur" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>