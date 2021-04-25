<?php


namespace App\Models;


class Image
{
    private ?int $id;
    private string $originalName;
    private string $path;
    private int $userId;

    public function __construct(string $originalName, string $path, int $userId, int $id = null)
    {
        $this->id = $id;
        $this->originalName = $originalName;
        $this->path = $path;
        $this->userId = $userId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

}