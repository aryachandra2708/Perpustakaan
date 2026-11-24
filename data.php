<?php
require_once "koneksi.php";

$sql = "SELECT id, no_anggota, nama_lengkap, email, no_hp, jenis_anggota, alamat
        FROM anggota
        ORDER BY id DESC";

$result = mysqli_query($koneksi, $sql);
$anggota_list = array();

if ($result) {
    // MYSQLI_ASSOC menghasilkan array asosiatif per baris (nama kolom sebagai key)
    $anggota_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
} else {
    $error_db = mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Anggota Perpustakaan</title>
<style>
    body { font-family: Arial, sans-serif; margin: 40px; }
    h1 { color: #1f3864; }
    table { border-collapse: collapse; width: 100%; margin-top: 16px; }
    th, td { border: 1px solid #ccc; padding: 8px 10px; text-align: left; }
    th { background: #f0f4f8; }
    .gagal { background: #fdecea; border-left: 5px solid #c0392b; padding: 10px; }
</style>
</head>
<body>
<h1>Daftar Anggota Perpustakaan</h1>
<p><a href="form_anggota.php">+ Tambah Anggota Baru</a></p>

<?php if (!empty($error_db)) { ?>
    <p class="gagal">Gagal mengambil data: <?php echo htmlspecialchars($error_db); ?></p>
<?php } elseif (empty($anggota_list)) { ?>
    <p>Belum ada data anggota terdaftar.</p>
<?php } else { ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Anggota</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor HP</th>
                <th>Jenis Anggota</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anggota_list as $index => $row) { ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($row["no_anggota"]); ?></td>
                    <td><?php echo htmlspecialchars($row["nama_lengkap"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><?php echo htmlspecialchars($row["no_hp"]); ?></td>
                    <td><?php echo htmlspecialchars($row["jenis_anggota"]); ?></td>
                    <td><?php echo htmlspecialchars($row["alamat"]); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
</body>
</html>