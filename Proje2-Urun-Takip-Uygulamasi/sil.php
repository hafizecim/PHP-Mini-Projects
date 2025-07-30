<?php
require_once "baglan.php";

if (!isset($is_numeric['id'])) {
    echo "Silinecek ürün ID'si belirtilmedi.";
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM urunler WHERE id = ?";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Silme işlemi başarısız: " . $stmt->error;
}
