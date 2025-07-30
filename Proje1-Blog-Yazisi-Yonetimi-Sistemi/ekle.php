<?php
require_once "baglan.php";

// Form gönderildiyse işle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST["baslik"];
    $icerik = $_POST["icerik"];

    // Güvenli veri girişi için prepare kullanımı önerilir ama bu temel haliyle:
    $sql = "INSERT INTO yazilar (baslik, icerik) VALUES (?, ?)";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("ss", $baslik, $icerik);

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
    <title>Yeni Yazı Ekle</title>
</head>
<body>
    <h1>Yeni Blog Yazısı Ekle</h1>
    <form action="" method="post">
        <label>Başlık:</label><br>
        <input type="text" name="baslik" required><br><br>

        <label>İçerik:</label><br>
        <textarea name="icerik" rows="10" cols="50" required></textarea><br><br>

        <button type="submit">Kaydet</button>
    </form>
    <br>
    <a href="index.php">Geri Dön</a>
</body>
</html>
