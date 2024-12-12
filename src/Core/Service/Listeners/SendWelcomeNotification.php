<?php

namespace Src\Core\Service\Listeners;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use SendGrid;
use SendGrid\Mail\Mail;
use SendGrid\Mail\TypeException;
use Src\Core\Domain\Events\UserRegistered;
use Symfony\Component\HttpFoundation\Response;

class SendWelcomeNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public int $delay = 10;
    public int $tries = 5;
    private LoggerInterface $logger;

    public function __construct()
    {
        $this->logger = Log::channel("sendgrid");
    }

    /**
     * @throws TypeException
     */
    public function handle(UserRegistered $event): void
    {
        try {
            $email = new Mail();
            $email->setFrom(config("mail.from.address"), config("mail.from.name"));
            $email->setSubject(
                Lang::get(
                    key: "email.welcome_email.subject",
                    replace: [
                        "service_name" => Lang::get(key: "attributes.news_aggregator", locale: $event->lang),
                    ],
                    locale: $event->lang,
                ),
            );
            $email->addTo($event->email);
            $email->addContent("text/html",
                Lang::get(
                    key: "email.welcome_email.body",
                    replace: [
                        "user_name" => $event->userName,
                        "service_name" => Lang::get(key: "attributes.news_aggregator", locale: $event->lang),
                    ],
                    locale: $event->lang,
                ),
            );

            $sendgrid = new SendGrid(config("notification.sendgrid.key"));
            $response = $sendgrid->send($email);

            if (
                $response->statusCode() >= Response::HTTP_OK &&
                $response->statusCode() < Response::HTTP_MULTIPLE_CHOICES
            ) {
                $this->logger->info("Welcome notification sent successfully to $event->email.");
            } else {
                $this->logger->error(
                    "Failed to send welcome notification to $event->email. Response: " . json_encode($response->body()),
                );
                throw new Exception("SendGrid error: " . json_encode($response->body()));
            }
        } catch (TypeException $e) {
            $this->logger->error("TypeException occurred while sending welcome notification: {$e->getMessage()}");
            throw $e;
        } catch (Exception $e) {
            $this->logger->error("Exception occurred while sending welcome notification: {$e->getMessage()}");
            throw $e;
        }
    }
}
