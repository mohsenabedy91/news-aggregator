<?php

namespace Src\Core\Domain\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegistered implements ShouldDispatchAfterCommit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public string $email,
        public string $otp,
        public string $userName,
        public string $lang,
    )
    {
        //
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("user-registered" . $this->email),
        ];
    }
}
