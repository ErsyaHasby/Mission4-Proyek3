<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <h4>Edit Mahasiswa</h4>
    </div>
    <div class="card-body">
        <form method="post" action="/admin/students/update/<?= esc($student['id']) ?>">
            <div class="mb-3">
                <label for="NIM" class="form-label">NIM</label>
                <input type="text" name="NIM" id="NIM" class="form-control" value="<?= esc($student['NIM']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= esc($student['nama']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="number" name="umur" id="umur" class="form-control" value="<?= esc($student['umur']) ?>"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>