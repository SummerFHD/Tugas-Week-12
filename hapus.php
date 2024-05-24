<?php
include 'koneksi.php';

try {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = $db->prepare("DELETE FROM tbbarang WHERE kdbarang = ?");
        $query->bindParam(1, $id);

        if ($query->execute()) {
            header("Location: list.php");
            exit;
        } else {
            echo "Error: Could not delete the record.";
        }
    } else {
        echo "Error: ID parameter missing.";
    }
} catch (PDOException $exception) {
    die("Connection error: " . $exception->getMessage());
}
?>

