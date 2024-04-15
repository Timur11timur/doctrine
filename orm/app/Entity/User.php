<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\StatusEnum;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[Entity]
#[Table('Users')]
#[HasLifecycleCallbacks]
class User
{
    #[Id]
    #[Column('ID'), GeneratedValue]
    private int $id;

    #[Column('FirstName')]
    private string $firstName;

    #[Column('LastName')]
    private string $lastName;

    #[Column('Email')]
    private string $email;

    #[Column('Password')]
    private string $password;

    #[Column('Roles')]
    private string $roles;

    #[Column('Status')]
    private StatusEnum $status;

    #[Column('NextMessageToSend', type: Types::SMALLINT, options: ['default' => 1])]
    private int $nextMessageToSend = 1;

    #[Column('LastEmailOn', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTime $lastEmailOn;

    #[Column('Options', nullable: true)]
    private ?string $options;

    #[Column('created_at')]
    private DateTime $createdAt;

    #[Column('updated_at')]
    private DateTime $updatedAt;

    #[PrePersist]
    public function onPrePersist(LifecycleEventArgs $args): void
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function setStatus(StatusEnum $status): User
    {
        $this->status = $status;

        return $this;
    }

    public function getNextMessageToSend(): int
    {
        return $this->nextMessageToSend;
    }

    public function setNextMessageToSend(int $nextMessageToSend): User
    {
        $this->nextMessageToSend = $nextMessageToSend;
        return $this;
    }

    public function getLastEmailOn(): ?DateTime
    {
        return $this->lastEmailOn;
    }

    public function setLastEmailOn(?DateTime $lastEmailOn): User
    {
        $this->lastEmailOn = $lastEmailOn;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(?string $options): User
    {
        $this->options = $options;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): User
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}