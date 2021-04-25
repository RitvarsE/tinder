<?php


namespace App\Models;


class Favorite
{
    private ?int $id;
    private int $userId;
    private int $favorite_id;
    private int $favorite;

    public function __construct(int $userId, int $favorite_id, int $favorite, int $id = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->favorite_id = $favorite_id;
        $this->favorite = $favorite;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getFavoriteId(): int
    {
        return $this->favorite_id;
    }

    public function getFavorite(): int
    {
        return $this->favorite;
    }
}