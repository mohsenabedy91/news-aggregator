<?php

return [
    "otp" => [
        "subject" => "Ihr Einmalpasswort (OTP) für :service_name",
        "title" => ":service_name - OTP-Verifizierung",
        "header" => <<<EOT
                <h1>Willkommen bei :service_name!</h1>
                <p>Ihr vertrauenswürdiger Service für sichere Transaktionen</p>
                EOT,
        "content" => <<<EOT
                <p>Lieber :user_name,</p>
                <p>Ihr Einmalpasswort (OTP) lautet: <span class="otp">:otp</span></p>
                <p>Bitte geben Sie diesen Code ein, um Ihre Anfrage abzuschließen.</p>
                <p>Mit besten Wünschen,<br>Das :service_name-Team</p>
                EOT,
        "footer" => "Das :service_name-Team. Alle Rechte vorbehalten.",
    ],
    "welcome" => [
        "subject" => "Willkommen bei :service_name!",
        "title" => "Willkommen bei :service_name",
        "header" => "Willkommen bei :service_name!",
        "content" => <<<EOT
                <p>Danke, dass Sie sich bei :service_name angemeldet haben. Wir freuen uns, Sie bei uns zu haben.</p>
                <p>Wenn Sie Fragen haben oder Hilfe benötigen, können Sie sich jederzeit an uns wenden.</p>
                <p>Mit freundlichen Grüßen,<br>Das :service_name-Team</p>
                EOT,
        "footer" => "Das :service_name-Team. Alle Rechte vorbehalten.",
    ],
];
