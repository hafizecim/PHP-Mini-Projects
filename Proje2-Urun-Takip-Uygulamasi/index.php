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
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        /* Başlık ve buton satırı */
        .header-bar {
            position: relative;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            margin: 0;
            font-size: 28px;
            color: #333;
        }

        /* Sağ köşedeki buton */
        .btn-add {
            position: absolute;
            right: 0;
            top: 0;
            padding: 10px 15px;
            background-color: green;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 16px;
        }

        th, td {
            border: 1px solid #999;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f3f3f3;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

    <!-- Başlık ortada, buton sağ üstte -->
    <div class="header-bar">
        <h1>📦 Ürün Listesi</h1>
        <a class="btn-add" href="ekle.php">➕ Yeni Ürün Ekle</a>
    </div>

    <!-- Ürün tablosu -->
    <table>
        <tr>
            <th>ID</th>
            <th>Ürün Adı</th>
            <th>Fiyat (TL)</th>
            <th>Stok Miktarı</th>
            <th>Eklenme Tarihi</th>
            <th>İşlemler</th>
        </tr>

        <?php while ($satir = $sonuc->fetch_assoc()): ?>
        <tr>
            <td><?php echo $satir['id']; ?></td>
            <td><?php echo htmlspecialchars($satir['ad']); ?></td>
            <td><?php echo number_format($satir['fiyat'], 2, ',', '.'); ?> TL</td>
            <td><?php echo $satir['stok_miktari']; ?></td>
            <td><?php echo $satir['tarih']; ?></td>
            <td>
                <a href="duzenle.php?id=<?php echo $satir['id']; ?>">✏️ Düzenle</a> | 
                <a href="sil.php?id=<?php echo $satir['id']; ?>" onclick="return confirm('Silmek istediğinize emin misiniz?');">🗑️ Sil</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
