<?php

return [
    "otp_email" => [
        "subject" => "Votre mot de passe à usage unique (OTP) pour :service_name",
        "body" => <<<EOT
                <p>Salutations de :service_name</p>
                <p>Cher/Chère :user_name,</p>
                <p>Votre mot de passe à usage unique (OTP) est : <b style='font-size:20px;'>:token</b></p>
                <p>Veuillez entrer ce code pour compléter votre demande.</p>
                EOT,
    ],
    "welcome_email" => [
        "subject" => "Bienvenue chez :service_name!",
        "body" => <<<EOT
                <p>Bonjour :user_name, bienvenue chez :service_name.</p>
                <p>Nous sommes ravis de vous accueillir parmi nous.</p>
                EOT,
    ],
];
