<?php
require_once "baglan.php";

// ID kontrolü
if (!isset($_GET["id"])) {
    echo "ID belirtilmedi.";
    exit();
}

$id = $_GET["id"];

// Güncelleme formu gönderildiyse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST["ad"];
    $fiyat= $_POST["fiyat"];
    $stok_miktari= $_POST["stok_miktari"];

    // Güvenli veri girişi için prepare kullanımı önerilir ama bu temel haliyle:
    $sql = "UPDATE urunler SET ad = ?, fiyat = ?, stok_miktari = ? WHERE id = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("sdii", $ad, $fiyat, $stok_miktari, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // Başarıyla eklendiyse ana sayfaya dön
        exit();
    } else {
        echo "Hata: " . $stmt->error;
    }
}

// Mevcut ürün bilgilerini al
$sql = "SELECT * FROM urunler WHERE id = ?";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$sonuc = $stmt->get_result();

if ($sonuc->num_rows == 0) {
    echo "Ürün bulunamadı.";
    exit();
}

$urun = $sonuc->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ürünü Bilgisini Düzenle</title>
</head>
<body>
    <h1>Ürünü Düzenle</h1>
    <form method="post">
        <label>Ad:</label><br>
        <input type="text" name="ad" value="<?php echo htmlspecialchars($urun['ad']); ?>" required><br><br>

        <label>Fiyat:</label><br>
        <input type="number" step="0.01" name="fiyat" value="<?php echo htmlspecialchars($urun['fiyat']); ?>" required><br><br>

        <label>Stok Miktarı:</label><br>
        <input type="number" name="stok_miktari" value="<?php echo htmlspecialchars($urun['stok_miktari']); ?>" required><br><br>

        <button type="submit">Güncelle</button>
    </form>
    <br>
    <a href="index.php">Geri Dön</a>
</body>
</html>
