<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Barang Baru</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<center>
    <div class="box">
        <form action="" method="POST">
            <table align="center" width="95%" height="95%">
                <tr>
                    <th colspan="2">Pendaftaran</th>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td><input type="text" name="namabarang" maxlength="50" size="50"></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type="text" name="qty" maxlength="100" size="100"></td>
                </tr>
                <tr>
                    <td>Harga Beli</td>
                    <td><input type="text" name="hargabeli" maxlength="100" size="100"></td>
                </tr>
                <tr>
                    <td>Harga Jual</td>
                    <td><input type="text" name="hargajual" maxlength="100" size="100"></td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type="submit" value="Simpan" name="simpan">
                        <a href='list.php'><button type='button'>Batal</button></a>
                    </th>
                </tr>
            </table>
        </form>
    </div>
</center>
</body>
</html>

<?php
if (isset($_POST['simpan'])) {
    include 'koneksi.php';

    $NamaBarang = $_POST['namabarang'];
    $Qty = $_POST['qty'];
    $HargaBeli = $_POST['hargabeli'];
    $HargaJual = $_POST['hargajual'];

    try {
        $query = $db->prepare("INSERT INTO tbbarang (namabarang, qty, hargabeli, hargajual) VALUES (?, ?, ?, ?)");
        $query->bindParam(1, $NamaBarang);
        $query->bindParam(2, $Qty);
        $query->bindParam(3, $HargaBeli);
        $query->bindParam(4, $HargaJual);
        $query->execute();

        echo "<script>alert('Data telah ditambahkan!'); window.location.replace('list.php');</script>";
    } catch (PDOException $exception) {
        die("Connection error: " . $exception->getMessage());
    }
}
?>
