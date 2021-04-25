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
        if (!$this->validateLogin()) {
            $_SESSION['_flash']['error'] = 'Login must be 4 to 20 symbols long and can contain only numbers and letters';
        }
        if (!$this->validateAge()) {
            $_SESSION['_flash']['error'] = 'You must be at least 18 years old';
        }
        if (!$this->validateGender()) {
            $_SESSION['_flash']['error'] = 'Choose your gender';
        }
        if (!$this->validatePassword()) {
            $_SESSION['_flash']['error'] = 'Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters';
        }
        return $this->validateLogin() && $this->validateAge() && $this->validatePassword() && $this->validateGender();
    }

    public function validateLogin(): bool
    {
        $login = $this->post['login'];
        return preg_match('/^[\p{L}\s]+$/u', $login) && strlen($login) >= 4 && strlen($login) < 20;
    }

    public function validateAge(): bool
    {
        $age = $this->post['age'];
        return ctype_digit($age) && $age >= 18 && $age < 100;
    }

    public function validatePassword(): bool
    {
        $password = $this->post['password'];
        return strlen($password) >= 8 && $password !== strtolower($password);
    }

    public function validateGender(): bool
    {
        return $this->post['gender'] === 0 || $this->post['gender'] === 1;
    }
}