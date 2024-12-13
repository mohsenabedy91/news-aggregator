<?php

return [
    "otp" => [
        "subject" => "Your One-Time Password (OTP) for :service_name",
        "title" => ":service_name - OTP Verification",
        "header" => <<<EOT
                <h1>Welcome to :service_name!</h1>
                <p>Your trusted service for secure transactions</p>
                EOT,
        "content" => <<<EOT
                <p>Dear :user_name,</p>
                <p>Your One-Time Password (OTP) is: <span class="otp">:otp</span></p>
                <p>Please enter this code to complete your request.</p>
                <p>Best wishes,<br>:service_name Team</p>
                EOT,
        "footer" => ":service_name Team. All rights reserved.",
    ],
    "welcome" => [
        "subject" => "Welcome to :service_name!",
        "title" => "Welcome to :service_name",
        "header" => "Welcome to :service_name!",
        "content" => <<<EOT
                <p>Thank you for joining :service_name. We're thrilled to have you with us.</p>
                <p>If you have any questions or need assistance, feel free to reach out.</p>
                <p>Best regards,<br>:service_name Team</p>
                EOT,
        "footer" => ":service_name Team. All rights reserved.",
    ],
];
