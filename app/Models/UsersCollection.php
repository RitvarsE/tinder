<?php


namespace App\Models;


class UsersCollection
{
    private array $users;

    public function __construct(array $users)
    {
        foreach ($users as $user) {
            $this->add($user);
        }
    }

    public function add(User $user): void
    {
        $this->users[] = $user;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function isEmpty(): bool
    {
        return empty($this->users);
    }
}