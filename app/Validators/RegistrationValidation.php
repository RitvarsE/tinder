<?php


namespace App\Validators;


class RegistrationValidation
{
    private array $post;

    public function __construct(array $post)
    {
        $this->post = $post;
    }

    public function validateRegistration(): bool
    {

        return $this->validateLogin() && $this->validateAge() && $this->validatePassword() && $this->validateGender();
    }

    public function validateLogin(): bool
    {
        $login = $this->post['login'];
        return ctype_alnum($login) && strlen($login) >= 6 && strlen($login) < 20;
    }

    public function validateAge(): bool
    {
        $age = $this->post['age'];
        return ctype_digit($age) && $age >= 18 && $age < 100;
    }

    public function validatePassword(): bool
    {
        $password = $this->post['password'];
        return strlen($password) >= 6 && $password !== strtolower($password);
    }

    public function validateGender(): bool
    {
        return $this->post['gender'] === 0 || $this->post['gender'] = 1;
    }
}