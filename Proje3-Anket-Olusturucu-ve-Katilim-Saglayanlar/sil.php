<?php
require_once "baglan.php";

if (!isset($_GET['d'])) {
    die("Anket ID belirtilmedi.");
}

$id = intval($_GET['d']); // Güvenlik için intval kullan

// 1. Önce oylar tablosundaki ilgili kayıtları sil
$stmt1 = $baglanti->prepare("DELETE FROM oylar WHERE anket_id = ?");
$stmt1->bind_param("i", $id);
$stmt1->execute();
$stmt1->close();

// 2. Sonra anketler tablosundan anketi sil
$stmt2 = $baglanti->prepare("DELETE FROM anketler WHERE id = ?");
$stmt2->bind_param("i", $id);
$stmt2->execute();

if ($stmt2->affected_rows > 0) {
    $stmt2->close();
    header("Location: index.php?msg=silindi");
    exit;
} else {
    $stmt2->close();
    die("Silme işlemi başarısız oldu veya anket bulunamadı.");
}
