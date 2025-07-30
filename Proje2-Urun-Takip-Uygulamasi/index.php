<?php
require_once "baglan.php";

$sql = "SELECT * FROM urunler ORDER BY tarih DESC";
$sonuc = $baglanti->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ürün Takip Uygulaması</title>
</head>
<body>
    <h1>Blog Yazıları</h1>
    <a href="ekle.php">Yeni ürün ekle</a>
    <hr>

    <?php while ($satir = $sonuc->fetch_assoc()): ?>
        <h2><?php echo htmlspecialchars($satir['ad']); ?></h2>
        <h2><?php echo htmlspecialchars($satir['fiyat']); ?></h2>
        <h2><?php echo htmlspecialchars($satir['stok_miktari']); ?></h2>
        <p><em><?php echo $satir['tarih']; ?></em></p>
        <a href="duzenle.php?id=<?php echo $satir['id']; ?>">Düzenle</a> | 
        <a href="sil.php?id=<?php echo $satir['id']; ?>" onclick="return confirm('Silmek istediğine emin misin?');">Sil</a>
        <hr>
    <?php endwhile; ?>
</body>
</html>
