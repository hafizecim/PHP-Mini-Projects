<?php
require 'baglan.php';
$id = $_GET['d'] ?? 0;

$anket = $baglanti->query("SELECT * FROM anketler WHERE id=$id")->fetch_assoc();
$oylar = $baglanti->query("SELECT secim, COUNT(*) as sayi FROM oylar WHERE anket_id=$id GROUP BY secim");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Anket Sonuçları</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 480px;
            width: 100%;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            color: #222;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 20px;
        }

        .bar-container {
            background-color: #eee;
            border-radius: 20px;
            overflow: hidden;
            height: 24px;
            width: 100%;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        }

        .bar {
            height: 100%;
            border-radius: 20px;
            background-color: #17a2b8;
            text-align: right;
            padding-right: 12px;
            color: white;
            font-weight: 600;
            line-height: 24px;
            white-space: nowrap;
            transition: width 0.5s ease;
        }

        .option-label {
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
        }

        a.home-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            font-weight: 600;
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }
        a.home-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($anket['soru']) ?></h1>

        <?php
        // Toplam oy sayısını hesapla
        $toplamOy = 0;
        $oylar->data_seek(0);
        while($oy = $oylar->fetch_assoc()) {
            $toplamOy += $oy['sayi'];
        }
        // Yeniden başa sar
        $oylar->data_seek(0);
        ?>

        <ul>
            <?php while($oy = $oylar->fetch_assoc()): 
                $oran = $toplamOy > 0 ? round(($oy['sayi'] / $toplamOy) * 100) : 0;
            ?>
                <li>
                    <div class="option-label"><?= htmlspecialchars($oy['secim']) ?> (<?= $oy['sayi'] ?> oy, %<?= $oran ?>)</div>
                    <div class="bar-container">
                        <div class="bar" style="width: <?= $oran ?>%; background-color: #17a2b8;"></div>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>

        <a class="home-link" href="index.php">← Anasayfaya Dön</a>
    </div>
</body>
</html>
