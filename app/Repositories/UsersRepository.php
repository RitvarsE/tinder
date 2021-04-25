<?php


namespace App\Repositories;


use Tests\Favorite;
use Tests\Image;
use Tests\User;
use Tests\UsersCollection;

interface UsersRepository
{
    public function verifyLogin(string $login, string $password): bool;

    public function hasUser(string $login): bool;

    public function create(User $user): void;

    public function getUser(string $login): User;

    public function setMainPicture(User $user, Image $image): void;

    public function getUsers(): UsersCollection;

    public function like(Favorite $favorite): void;

    public function dislike(Favorite $favorite): void;

    public function getFavorites(User $user, int $status = null): UsersCollection;


}