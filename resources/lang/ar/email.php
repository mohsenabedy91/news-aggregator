<?php

return [
    "otp" => [
        "subject" => "كلمة المرور لمرة واحدة (OTP) لـ :service_name",
        "title" => ":service_name - التحقق من OTP",
        "header" => <<<EOT
                <h1>مرحبًا بك في :service_name!</h1>
                <p>خدمتك الموثوقة للمعاملات الآمنة</p>
                EOT,
        "content" => <<<EOT
                <p>عزيزي :user_name،</p>
                <p>كلمة المرور لمرة واحدة (OTP) هي: <span class="otp">:otp</span></p>
                <p>يرجى إدخال هذا الرمز لإتمام طلبك.</p>
                <p>مع أطيب التحيات،<br>فريق :service_name</p>
                EOT,
        "footer" => "فريق :service_name. جميع الحقوق محفوظة.",
    ],
    "welcome" => [
        "subject" => "مرحبًا بك في :service_name!",
        "title" => "مرحبًا بك في :service_name",
        "header" => "مرحبًا بك في :service_name!",
        "content" => <<<EOT
                <p>شكرًا لانضمامك إلى :service_name. نحن متحمسون لأنك معنا.</p>
                <p>إذا كانت لديك أي أسئلة أو تحتاج إلى مساعدة، لا تتردد في الاتصال بنا.</p>
                <p>أطيب التحيات،<br>فريق :service_name</p>
                EOT,
        "footer" => "فريق :service_name. جميع الحقوق محفوظة.",
    ],
];
