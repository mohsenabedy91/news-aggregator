<?php

namespace Src\Core\Domain;

use DateTime;

class OTPEntity
{
    private string $value;
    private bool $used;
    private int $requestCount;
    private DateTime $createdAt;
    private DateTime $lastRequest;

    public function __construct(
        string   $value = "",
        bool     $used = false,
        int      $requestCount = 1,
        DateTime $createdAt = null,
        DateTime $lastRequest = null
    )
    {
        $this->value = $value;
        $this->used = $used;
        $this->requestCount = $requestCount;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->lastRequest = $lastRequest ?? new DateTime();
    }

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->setValue($data["value"] ?? "");
        $instance->setUsed($data["used"] ?? false);
        $instance->setRequestCount($data["requestCount"] ?? 0);
        $instance->setCreatedAt($data["createdAt"]);
        $instance->setLastRequest($data["createdAt"]);

        return $instance;
    }

    public function toArray(): array
    {
        return [
            "value" => $this->getValue(),
            "used" => $this->isUsed(),
            "requestCount" => $this->getRequestCount(),
            "createdAt" => $this->getCreatedAt()->getTimestamp(),
            "lastRequest" => $this->getLastRequest()->getTimestamp(),
        ];
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): OTPEntity
    {
        $this->value = $value;
        return $this;
    }

    public function isUsed(): bool
    {
        return $this->used;
    }

    public function setUsed(bool $used): OTPEntity
    {
        $this->used = $used;
        return $this;
    }

    public function getRequestCount(): int
    {
        return $this->requestCount;
    }

    public function setRequestCount(int $requestCount): OTPEntity
    {
        $this->requestCount = $requestCount;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): OTPEntity
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getLastRequest(): DateTime
    {
        return $this->lastRequest;
    }

    public function setLastRequest(DateTime $lastRequest): OTPEntity
    {
        $this->lastRequest = $lastRequest;
        return $this;
    }
}
