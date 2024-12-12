<?php

return [
    "otp_email" => [
        "subject" => "كلمة المرور المؤقتة (OTP) لخدمة :service_name",
        "body" => <<<EOT
                <p>تحياتنا من :service_name</p>
                <p>عزيزي :user_name،</p>
                <p>كلمة المرور المؤقتة (OTP) الخاصة بك هي: <b style='font-size:20px;'>:token</b></p>
                <p>يرجى إدخال هذا الرمز لإكمال طلبك.</p>
                EOT,
    ],
    "welcome_email" => [
        "subject" => "مرحبًا بك في :service_name!",
        "body" => <<<EOT
                <p>مرحبًا :user_name، أهلاً وسهلاً بك في :service_name.</p>
                <p>نحن سعداء بانضمامك إلينا.</p>
                EOT,
    ],
];
