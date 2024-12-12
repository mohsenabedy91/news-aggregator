<?php

return [
    "otp_email" => [
        "subject" => ":service_name için Tek Seferlik Şifreniz (OTP)",
        "body" => <<<EOT
                <p>:service_name'den selamlar</p>
                <p>Sayın :user_name,</p>
                <p>Tek Seferlik Şifreniz (OTP): <b style='font-size:20px;'>:token</b></p>
                <p>Talebinizi tamamlamak için lütfen bu kodu girin.</p>
                EOT,
    ],
    "welcome_email" => [
        "subject" => ":service_name'a Hoş Geldiniz!",
        "body" => <<<EOT
                <p>Merhaba :user_name, :service_name'a hoş geldiniz.</p>
                <p>Aramızda olduğunuz için mutluyuz.</p>
                EOT,
    ],
];
