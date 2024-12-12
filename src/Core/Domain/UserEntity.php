<?php

namespace Src\Core\Domain;

class UserEntity
{
    public function __construct(
        public ?int    $id,
        public string  $firstName,
        public string  $lastName,
        public string  $email,
        public string  $password,
        public ?string $accessToken,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data["id"] ?? null,
            firstName: $data["first_name"],
            lastName: $data["last_name"],
            email: $data["email"],
            password: $data["password"],
            accessToken: $data["accessToken"] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "email" => $this->email,
            "password" => $this->password,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFullName(): string
    {
        return $this->getFirstName() . " " . $this->getLastName();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }
}
