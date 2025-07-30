<?php
require_once "baglan.php";

// Form gönderildiyse işle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST["ad"];
    $fiyat= $_POST["fiyat"];
    $stok_miktari= $_POST["stok_miktari"];

    // Güvenli veri girişi için prepare kullanımı önerilir ama bu temel haliyle:
    $sql = "INSERT INTO urunler (ad, fiyat, stok_miktari) VALUES (?, ?, ?)";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("sdi", $ad, $fiyat, $stok_miktari);

    if ($stmt->execute()) {
        header("Location: index.php"); // Başarıyla eklendiyse ana sayfaya dön
        exit();
    } else {
        echo "Hata: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Yeni Ürün Ekle</title>
</head>
<body>
    <h1>Yeni Stok Ekleme Sayfası</h1>
    <form action="" method="post">
        <label>Ad:</label><br>
        <input type="text" name="ad" required><br><br>

        <label>Fiyat:</label><br>
        <input type="text" name="fiyat" required><br><br>

        <label>Stok Miktarı:</label><br>
        <input type="text" name="stok_miktari" required><br><br>

        <button type="submit">Kaydet</button>
    </form>
    <br>
    <a href="index.php">Geri Dön</a>
</body>
</html>
