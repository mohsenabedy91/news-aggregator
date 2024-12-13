<?php

return [
    "otp" => [
        "subject" => ":service_name için Tek Kullanımlık Şifreniz (OTP)",
        "title" => ":service_name - OTP Doğrulaması",
        "header" => <<<EOT
                <h1>:service_name'ye Hoş Geldiniz!</h1>
                <p>Güvenli işlemler için güvenilir hizmetiniz</p>
                EOT,
        "content" => <<<EOT
                <p>Sayın :user_name,</p>
                <p>Tek kullanımlık şifreniz (OTP) şudur: <span class="otp">:otp</span></p>
                <p>Lütfen bu kodu isteğinizi tamamlamak için giriniz.</p>
                <p>İyi dileklerimizle,<br>:service_name Ekibi</p>
                EOT,
        "footer" => ":service_name Ekibi. Tüm hakları saklıdır.",
    ],
    "welcome" => [
        "subject" => ":service_name'ye Hoş Geldiniz!",
        "title" => ":service_name'ye Hoş Geldiniz",
        "header" => ":service_name'ye Hoş Geldiniz!",
        "content" => <<<EOT
                <p>:service_name'ye katıldığınız için teşekkür ederiz. Sizi aramızda görmekten mutluluk duyuyoruz.</p>
                <p>Herhangi bir sorunuz olursa veya yardıma ihtiyacınız olursa, bizimle iletişime geçmekten çekinmeyin.</p>
                <p>Saygılarımızla,<br>:service_name Ekibi</p>
                EOT,
        "footer" => ":service_name Ekibi. Tüm hakları saklıdır.",
    ],
];
