<?php
require_once "baglan.php";

$sql = "SELECT * FROM yazilar ORDER BY tarih DESC";
$sonuc = $baglanti->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blog Yazıları</title>
</head>
<body>
    <h1>Blog Yazıları</h1>
    <a href="ekle.php">Yeni Yazı Ekle</a>
    <hr>

    <?php while ($satir = $sonuc->fetch_assoc()): ?>
        <h2><?php echo htmlspecialchars($satir['baslik']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($satir['icerik'])); ?></p>
        <p><em><?php echo $satir['tarih']; ?></em></p>
        <a href="duzenle.php?id=<?php echo $satir['id']; ?>">Düzenle</a> | 
        <a href="sil.php?id=<?php echo $satir['id']; ?>" onclick="return confirm('Silmek istediğine emin misin?');">Sil</a>
        <hr>
    <?php endwhile; ?>
</body>
</html>
