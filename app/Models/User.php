<?php

namespace App\Models;

class User
{
    private ?int $id;
    private string $password;
    private int $age;
    private ?Image $profilePicture;
    private bool $gender;
    private string $login;

    public function __construct(
        string $login,
        string $password,
        int $age,
        bool $gender,
        Image $profilePicture = null,
        int $id = null)
    {
        $this->id = $id;
        $this->password = $password;
        $this->age = $age;
        $this->profilePicture = $profilePicture;
        $this->gender = $gender;
        $this->login = $login;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getProfilePicture(): ?Image
    {
        return $this->profilePicture;
    }


    public function isGender(): bool
    {
        return $this->gender;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

}