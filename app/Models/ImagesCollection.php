<?php


namespace App\Models;


class ImagesCollection
{
    private array $images;

    public function __construct(array $images)
    {
        foreach ($images as $image) {
            $this->add($image);
        }
    }

    public function add(Image $image): void
    {
        $this->images[] = $image;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function isEmpty(): bool
    {
        return empty($this->images);
    }
}