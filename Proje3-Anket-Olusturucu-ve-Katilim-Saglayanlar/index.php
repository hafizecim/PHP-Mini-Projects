<?php
require_once "baglan.php"; // Veritabanı bağlantısı

// Anketleri çek
$sql = "SELECT * FROM anketler ORDER BY id DESC";
$anketler = $baglanti->query($sql);

// Sorgu hatası kontrolü
if (!$anketler) {
    die("Sorgu hatası: " . $baglanti->error);
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Anket Listesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f8f9fa;
            margin: 0;
        }

        /* Başlık alanı */
        .header-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            /* Yazıyı ortala */
            position: relative;
            /* Butonu sağa konumlandırmak için */
            margin-bottom: 30px;
        }

        /* Başlık */
        h1 {
            font-size: 32px;
            color: #333;
            margin: 0;
            text-align: center;
        }

        /* Butonu sağa yerleştir */
        .btn-add {
            position: absolute;
            /* Konumu header-bar göreceli */
            right: 195px;
            /* Sağdan 20px boşluk */
            padding: 10px 30px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-add:hover {
            background-color: #218838;
        }

        /* Anketler tablosu */
        table {
            margin: 0 auto;
            width: 70%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {

            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            
        }

        th {
            padding: 20px 20px;
            background-color: #f3f3f3;
            font-weight: 800;
        }

        tr:hover {
            background-color: #f1f7f9;
        }

        /* Link butonları */
        .btn-link {
            display: inline-block;
    padding: 7px 5px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    color: white;
    transition: background-color 0.3s ease;
    margin: 0; /* margin kaldır */
    text-align: center; /* yazıyı ortala */
            margin-right: 2px; /* Butonlar arası boşluk */
        }

        .btn-view {
            background-color: #007bff;
        }

        .btn-view:hover {
            background-color: #0056b3;
        }

        .btn-vote {
            background-color: #17a2b8;
        }

        .btn-vote:hover {
            background-color: #0f6674;
        }

        .btn-del {
            background-color: #ec9becff;
        }

        .btn-del:hover {
            background-color: #a00ba5ff;
        }
    </style>
</head>

<body>

    <div class="header-bar">
        <h1>📋 Anketler</h1>
        <a class="btn-add" href="olustur.php">➕ Yeni Anket Oluştur</a>
    </div>

    <?php if ($anketler->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Anket Sorusu</th>
                    <th style="width: 160px;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($anket = $anketler->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($anket['soru']) ?></td>
                        <td>
                            <a class="btn-link btn-view" href="sonuclar.php?d=<?= $anket['id'] ?>">Görüntüle</a>
                            <a class="btn-link btn-vote" href="detay.php?d=<?= $anket['id'] ?>">Oy Ver</a>
                            <a class="btn-link btn-del" href="sil.php?d=<?= $anket['id'] ?>">Sil</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Henüz anket bulunmuyor.</p>
    <?php endif; ?>

</body>

</html>