<?php

return [
    "otp_email" => [
        "subject" => "Ihr Einmalpasswort (OTP) für :service_name",
        "body" => <<<EOT
                <p>Grüße von :service_name</p>
                <p>Sehr geehrte/r :user_name,</p>
                <p>Ihr Einmalpasswort (OTP) lautet: <b style='font-size:20px;'>:token</b></p>
                <p>Bitte geben Sie diesen Code ein, um Ihre Anfrage abzuschließen.</p>
                EOT,
    ],
    "welcome_email" => [
        "subject" => "Willkommen bei :service_name!",
        "body" => <<<EOT
                <p>Hallo :user_name, willkommen bei :service_name.</p>
                <p>Wir freuen uns, Sie an Bord zu haben.</p>
                EOT,
    ],
];
