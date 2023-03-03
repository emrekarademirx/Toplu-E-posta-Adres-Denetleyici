<?php

// E-posta adres listesi
$email_list = array();

// E-posta adreslerini ekle
// Manuel olarak
$email_list[] = "example1@gmail.com";
$email_list[] = "example2@hotmail.com";
$email_list[] = "example3@yandex.com";

// Dosyadan okuma
// 500 adet e-posta adresi maksimum
if (isset($_FILES['email_file'])) {
  $email_file = file($_FILES['email_file']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $email_list = array_merge($email_list, array_slice($email_file, 0, 500));
}

// E-posta adreslerini denetle
foreach ($email_list as $email) {
  // E-posta sağlayıcısını tespit et
  $email_provider = explode("@", $email)[1];

  // E-posta sağlayıcısına göre renk ve mesaj
  if (in_array($email_provider, array("gmail.com", "google.com"))) {
    $color = "green";
    $message = "Gmail provider";
  } else if (in_array($email_provider, array("hotmail.com", "outlook.com"))) {
    $color = "blue";
    $message = "Hotmail provider";
  } else if ($email_provider == "yandex.com") {
    $color = "purple";
    $message = "Yandex provider";
  } else {
    $color = "red";
    $message = "Unknown provider";
  }

  // Sonuçları ekrana yazdır
  echo "<p style='color: $color'>$email - $message</p>";
}

?>

<!-- Dosya yükleme formu -->
<form action="" method="post" enctype="multipart/form-data">
  <input type="file" name="email_file">
  <input type="submit" value="Submit">
</form>
