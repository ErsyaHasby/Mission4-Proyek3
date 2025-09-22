<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
</head>

<body>
    <h2><?= $title ?></h2>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <h3>Tambah Enrollment</h3>
    <form action="/enrollment/store" method="post">
        <label>Mahasiswa:</label>
        <select name="user_id" required>
            <option value="">--Pilih Mahasiswa--</option>
            <?php foreach ($users as $u): ?>
                <option value="<?= $u['id'] ?>"><?= $u['username'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Course:</label>
        <select name="course_id" required>
            <option value="">--Pilih Course--</option>
            <?php foreach ($courses as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['title'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Tambah</button>
    </form>

    <hr>

    <h3>Daftar Enrollment</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Course ID</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($enrollments as $e): ?>
            <tr>
                <td><?= $e['id'] ?></td>
                <td><?= $e['user_id'] ?></td>
                <td><?= $e['course_id'] ?></td>
                <td>
                    <a href="/enrollment/delete/<?= $e['id'] ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>