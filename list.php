<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css" media="all">
    <title>Data Barang</title>
</head>
<body>
<center>
    <h1><strong>Data Semua Barang</strong></h1>
    <div class="box">
        <form action="" method="post">
            <input type="text" name="text" placeholder="Cari data" size="50">
            <input type="submit" name="cari" value="Cari">
            <br>
        </form>
        <table width='95%' border="1" cellpadding="0" cellspacing="0">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th><a href="form.php"><button type="button">TAMBAH</button></a></th>
            </tr>
            <?php
            include 'koneksi.php';
            try {
                if (isset($_POST['cari'])) {
                    $text = "%" . $_POST['text'] . "%";
                    $query = $db->prepare("SELECT * FROM tbbarang WHERE namabarang LIKE ? OR qty LIKE ?");
                    $query->bindParam(1, $text);
                    $query->bindParam(2, $text);
                } else {
                    $query = $db->prepare("SELECT * FROM tbbarang");
                }
                $query->execute();
                $data = $query->fetchAll();
            } catch (PDOException $exception) {
                die("Connection error: " . $exception->getMessage());
            }

            foreach ($data as $value) {
                echo "<tr>
                        <td>{$value['kdbarang']}</td>
                        <td>{$value['namabarang']}</td>
                        <td>{$value['qty']}</td>
                        <td>{$value['hargabeli']}</td>
                        <td>{$value['hargajual']}</td>
                        <td align='center'>
                            <a href='edit.php?kdbarang={$value['kdbarang']}'><button>Edit</button></a>
                            <a href='hapus.php?id={$value['kdbarang']}' onclick=\"return confirm('Are you sure you want to delete this item?');\"><button>Delete</button></a>
                        </td>
                    </tr>";
            }
            ?>
        </table>
    </div>
</center>
</body>
</html>
