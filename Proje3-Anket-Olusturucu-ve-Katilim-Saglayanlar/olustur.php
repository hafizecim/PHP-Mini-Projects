<?php
require 'baglan.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $soru = $_POST['soru'];
    $sec1 = $_POST['secenek1'];
    $sec2 = $_POST['secenek2'];
    $sec3 = $_POST['secenek3'];

    $stmt = $baglanti->prepare("INSERT INTO anketler (soru, secenek1, secenek2, secenek3) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Sorgu hazırlanırken hata: " . $baglanti->error);
    }

    $stmt->bind_param("ssss", $soru, $sec1, $sec2, $sec3);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: index.php");
        exit;
    } else {
        echo "Anket eklenirken hata oluştu: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Yeni Anket Oluştur</title>
    <style>
        /* Sayfa ortalama ve genel font */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form kapsayıcı */
        .form-container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 400px;
        }

        /* Başlık */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            letter-spacing: 1.2px;
        }

        /* Label stilleri */
        label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            font-size: 16px;
        }

        /* Input kutuları */
        input[type="text"] {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 20px;
            border: 1.8px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease;
            outline: none;
        }
        input[type="text"]:focus {
            border-color: #28a745;
            box-shadow: 0 0 8px rgba(40, 167, 69, 0.3);
        }

        /* Buton */
        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            border: none;
            color: white;
            font-weight: 700;
            font-size: 17px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 5px 10px rgba(40, 167, 69, 0.3);
        }
        button:hover {
            background-color: #218838;
            box-shadow: 0 7px 15px rgba(33, 136, 56, 0.5);
        }

        /* Responsive küçük ekranlarda genişliği azalt */
        @media (max-width: 450px) {
            .form-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Yeni Anket Oluştur</h1>
        <form method="POST">
            <label for="soru">Soru:</label>
            <input id="soru" type="text" name="soru" required placeholder="Anket sorusunu giriniz..." />

            <label for="secenek1">Seçenek 1:</label>
            <input id="secenek1" type="text" name="secenek1" required placeholder="Birinci seçenek" />

            <label for="secenek2">Seçenek 2:</label>
            <input id="secenek2" type="text" name="secenek2" required placeholder="İkinci seçenek" />

            <label for="secenek3">Seçenek 3:</label>
            <input id="secenek3" type="text" name="secenek3" placeholder="Üçüncü seçenek (isteğe bağlı)" />

            <button type="submit">Kaydet</button>
        </form>
    </div>
</body>
</html>
