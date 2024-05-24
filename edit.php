<?php
include 'koneksi.php';

if (isset($_GET['kdbarang'])) {
    $KodeBarang = $_GET['kdbarang'];

    try {
        $query = $db->prepare("SELECT * FROM tbbarang WHERE kdbarang = ?");
        $query->bindParam(1, $KodeBarang);
        $query->execute();
        $data = $query->fetch();
    } catch (PDOException $exception) {
        die("Connection error: " . $exception->getMessage());
    }
} else {
    echo "Error: ID parameter missing.";
    exit;
}

if (isset($_POST['simpan'])) {
    $NamaBarang = $_POST['namabarang'];
    $Qty = $_POST['qty'];
    $HargaBeli = $_POST['hargabeli'];
    $HargaJual = $_POST['hargajual'];

    try {
        $query = $db->prepare("UPDATE tbbarang SET namabarang = ?, qty = ?, hargabeli = ?, hargajual = ? WHERE kdbarang = ?");
        $query->bindParam(1, $NamaBarang);
        $query->bindParam(2, $Qty);
        $query->bindParam(3, $HargaBeli);
        $query->bindParam(4, $HargaJual);
        $query->bindParam(5, $KodeBarang);
        $query->execute();

        echo "<script>alert('Data telah diupdate!'); window.location.replace('listbarang.php');</script>";
    } catch (PDOException $exception) {
        die("Connection error: " . $exception->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Form Barang</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<center>
    <div class="box">
        <form action="" method="POST">
            <input type="hidden" name="kdbarang" value="<?php echo $data['kdbarang']; ?>">
            <table align="center" width="95%" height="95%">
                <tr>
                    <th colspan="2">Edit Form Barang</th>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td><input type="text" name="namabarang" maxlength="100" size="100" value="<?php echo $data['namabarang']; ?>"></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td><input type="text" name="qty" maxlength="100" size="100" value="<?php echo $data['qty']; ?>"></td>
                </tr>
                <tr>
                    <td>Harga Beli</td>
                    <td><input type="text" name="hargabeli" maxlength="100" size="100" value="<?php echo $data['hargabeli']; ?>"></td>
                </tr>
                <tr>
                    <td>Harga Jual</td>
                    <td><input type="text" name="hargajual" maxlength="100" size="100" value="<?php echo $data['hargajual']; ?>"></td>
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
