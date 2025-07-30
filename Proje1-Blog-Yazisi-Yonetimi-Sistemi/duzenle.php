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
    $baslik = $_POST["baslik"];
    $icerik = $_POST["icerik"];

    $sql = "UPDATE yazilar SET baslik = ?, icerik = ? WHERE id = ?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("ssi", $baslik, $icerik, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Hata: " . $stmt->error;
    }
}

// Mevcut yazıyı çek
$sql = "SELECT * FROM yazilar WHERE id = ?";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$sonuc = $stmt->get_result();

if ($sonuc->num_rows == 0) {
    echo "Yazı bulunamadı.";
    exit();
}

$yazi = $sonuc->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Yazıyı Düzenle</title>
</head>
<body>
    <h1>Yazıyı Düzenle</h1>
    <form method="post">
        <label>Başlık:</label><br>
        <input type="text" name="baslik" value="<?php echo htmlspecialchars($yazi['baslik']); ?>" required><br><br>

        <label>İçerik:</label><br>
        <textarea name="icerik" rows="10" cols="50" required><?php echo htmlspecialchars($yazi['icerik']); ?></textarea><br><br>

        <button type="submit">Güncelle</button>
    </form>
    <br>
    <a href="index.php">Geri Dön</a>
</body>
</html>
