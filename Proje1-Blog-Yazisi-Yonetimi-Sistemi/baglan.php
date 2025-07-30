<?php
$host = "localhost";
$kullanici = "root";
$sifre = "";
$veritabani = "blog";

$baglanti = new mysqli($host, $kullanici, $sifre, $veritabani);

if ($baglanti->connect_error) {
    // Eğer bu dosya direkt çağrıldıysa, mesaj göster
    if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        echo '<div style="color: white; background-color: red; padding: 10px; text-align: center;">
         Veritabanına bağlanılamadı: ' . $baglanti->connect_error . '
    </div>';
        // die("Bağlantı hatası: " . $baglanti->connect_error); // Hata mesajını gösterdikten sonra işlemi sonlandırmak istemiyorsanız bu satırı yorum satırı haline getirin.
    }
} else {
    // Eğer bu dosya direkt çağrıldıysa, mesaj göster
    if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        echo '<div style="color: white; background-color: green; padding: 10px; text-align: center;">
         Veritabanına başarıyla bağlanıldı.
    </div>';
    }
}

?>