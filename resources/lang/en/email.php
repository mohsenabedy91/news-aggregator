<?php

return [
    "otp_email" => [
        "subject" => "Your One-Time Password (OTP) for :service_name",
        "body" => <<<EOT
                <p>Greetings from :service_name</p>
                <p>Dear :user_name,</p>
                <p>Your One-Time Password (OTP) is: <b style='font-size:20px;'>:token</b></p>
                <p>Please enter this code to complete your request.</p>
                EOT,
    ],
    "welcome_email" => [
        "subject" => "Welcome to :service_name!",
        "body" => <<<EOT
                <p>Hello :user_name, Welcome to :service_name. </p>
                <p>We're glad to have you on board.</p>
                EOT,
    ],
];
