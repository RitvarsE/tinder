<?php


namespace App\Repositories;


use App\Models\Favorite;
use App\Models\Image;
use App\Models\User;
use App\Models\UsersCollection;

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