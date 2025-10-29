<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="p-4">
        <h3>Edit Pegawai</h3>
        <form method="post" action="<?= site_url('pegawai/update/' . $pegawai['id']) ?>" class="mt-3" style="max-width: 400px;">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pegawai</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($pegawai['nama']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= site_url('pegawai') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>