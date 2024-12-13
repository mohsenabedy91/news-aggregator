<?php

return [
    "otp" => [
        "subject" => "Votre mot de passe à usage unique (OTP) pour :service_name",
        "title" => ":service_name - Vérification OTP",
        "header" => <<<EOT
                <h1>Bienvenue sur :service_name !</h1>
                <p>Votre service de confiance pour des transactions sécurisées</p>
                EOT,
        "content" => <<<EOT
                <p>Cher(e) :user_name,</p>
                <p>Votre mot de passe à usage unique (OTP) est : <span class="otp">:otp</span></p>
                <p>Veuillez entrer ce code pour compléter votre demande.</p>
                <p>Cordialement,<br>L'équipe :service_name</p>
                EOT,
        "footer" => "L'équipe :service_name. Tous droits réservés.",
    ],
    "welcome" => [
        "subject" => "Bienvenue sur :service_name !",
        "title" => "Bienvenue sur :service_name",
        "header" => "Bienvenue sur :service_name !",
        "content" => <<<EOT
                <p>Merci de rejoindre :service_name. Nous sommes ravis de vous avoir parmi nous.</p>
                <p>Si vous avez des questions ou avez besoin d'aide, n'hésitez pas à nous contacter.</p>
                <p>Cordialement,<br>L'équipe :service_name</p>
                EOT,
        "footer" => "L'équipe :service_name. Tous droits réservés.",
    ],
];
