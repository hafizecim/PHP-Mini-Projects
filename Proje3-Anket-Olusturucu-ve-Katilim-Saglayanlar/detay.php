<?php
require 'baglan.php';
$id = $_GET['d'] ?? 0;

$anket = $baglanti->query("SELECT * FROM anketler WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici = $_POST['kullanici_ad'];
    $secim = $_POST['secim'];

    $stmt = $baglanti->prepare("INSERT INTO oylar (anket_id, kullanici_ad, secim) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $kullanici, $secim);
    $stmt->execute();

    header("Location: sonuclar.php?d=$id");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Anket Detayı</title>
    <style>
        /* Genel sayfa ayarları */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f8fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        /* Form kapsayıcı */
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 480px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Başlık */
        h1 {
            text-align: center;
            font-size: 28px;
            color: #222;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        /* Form elemanları */
        form label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            font-size: 16px;
        }

        form input[type="text"] {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 25px;
            border: 1.8px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease;
            outline: none;
            box-sizing: border-box;
        }

        form input[type="text"]:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 8px rgba(23, 162, 184, 0.3);
        }

        /* Radio buttonlar */
        .options {
            margin-bottom: 30px;
        }
        .options label {
            font-weight: normal;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 15px;
            color: #333;
        }
        .options input[type="radio"] {
            margin-right: 12px;
            accent-color: #17a2b8; /* Modern tarayıcılar için */
            cursor: pointer;
            width: 18px;
            height: 18px;
        }

        /* Buton */
        button {
            width: 100%;
            padding: 14px;
            background-color: #17a2b8;
            border: none;
            color: white;
            font-weight: 700;
            font-size: 17px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 5px 10px rgba(23, 162, 184, 0.3);
        }
        button:hover {
            background-color: #138496;
            box-shadow: 0 7px 15px rgba(19, 132, 150, 0.6);
        }

        /* Sonuç linki */
        .result-link {
            display: block;
            margin-top: 25px;
            text-align: center;
            font-weight: 600;
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }
        .result-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 520px) {
            .container {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><?= htmlspecialchars($anket['soru']) ?></h1>
        <form method="POST">
            <label for="kullanici_ad">Adınız:</label>
            <input id="kullanici_ad" type="text" name="kullanici_ad" required placeholder="Adınızı giriniz..." />

            <div class="options">
                <label>
                    <input type="radio" name="secim" value="<?= htmlspecialchars($anket['secenek1']) ?>" required />
                    <?= htmlspecialchars($anket['secenek1']) ?>
                </label>
                <label>
                    <input type="radio" name="secim" value="<?= htmlspecialchars($anket['secenek2']) ?>" />
                    <?= htmlspecialchars($anket['secenek2']) ?>
                </label>
                <label>
                    <input type="radio" name="secim" value="<?= htmlspecialchars($anket['secenek3']) ?>" />
                    <?= htmlspecialchars($anket['secenek3']) ?>
                </label>
            </div>

            <button type="submit">Oy Ver</button>
        </form>

        <a class="result-link" href="sonuclar.php?d=<?= $id ?>">Sonuçları Gör</a>
    </div>

</body>
</html>
