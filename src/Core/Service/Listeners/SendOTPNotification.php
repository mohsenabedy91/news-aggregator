<?php

namespace Src\Core\Service\Listeners;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Psr\Log\LoggerInterface;
use SendGrid;
use SendGrid\Mail\Mail;
use SendGrid\Mail\TypeException;
use Src\Core\Domain\Events\UserRegistered;
use Symfony\Component\HttpFoundation\Response;

class SendOTPNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public int $tries = 5;
    private LoggerInterface $logger;

    public function __construct()
    {
        $this->logger = Log::channel(channel: "sendgrid");
    }

    /**
     * @throws TypeException
     */
    public function handle(UserRegistered $event): void
    {
        try {
            $serviceName = Lang::get(key: "attributes.news_aggregator", locale: $event->lang);
            $data = [
                "lang" => $event->lang,
                "title" => Lang::get(
                    key: "email.otp.title",
                    replace: ["service_name" => $serviceName],
                    locale: $event->lang,
                ),
                "header" => Lang::get(
                    key: "email.otp.header",
                    replace: ["service_name" => $serviceName],
                    locale: $event->lang,
                ),
                "content" => Lang::get(
                    key: "email.otp.content",
                    replace: [
                        "user_name" => $event->userName,
                        "otp" => $event->otp,
                        "service_name" => $serviceName,
                    ],
                    locale: $event->lang,
                ),
                "footer" => Lang::get(
                    key: "email.otp.footer",
                    replace: ["service_name" => $serviceName],
                    locale: $event->lang,
                ),
            ];

            $htmlContent = View::make(view: "emails.otp", data: $data)->render();

            $email = new Mail();
            $email->setFrom(config(key: "mail.from.address"), config(key: "mail.from.name"));
            $email->setSubject(
                subject: Lang::get(
                    key: "email.otp.subject",
                    replace: ["service_name" => $serviceName],
                    locale: $event->lang,
                ),
            );
            $email->addTo(to: $event->email);
            $email->addContent(type: "text/html", value: $htmlContent);

            $sendgrid = new SendGrid(apiKey: config(key: "notification.sendgrid.key"));
            $response = $sendgrid->send(email: $email);

            if (
                $response->statusCode() >= Response::HTTP_OK &&
                $response->statusCode() < Response::HTTP_MULTIPLE_CHOICES
            ) {
                $this->logger->info("OTP notification sent successfully to $event->email.");
            } else {
                $this->logger->error(
                    "Failed to send OTP notification to $event->email. Response: " . json_encode(value: $response->body()),
                );
                throw new Exception("SendGrid error: " . json_encode(value: $response->body()));
            }
        } catch (TypeException $e) {
            $this->logger->error("TypeException occurred while sending OTP notification: {$e->getMessage()}");
            throw $e;
        } catch (Exception $e) {
            $this->logger->error("Exception occurred while sending OTP notification: {$e->getMessage()}");
            throw $e;
        }
    }
}
