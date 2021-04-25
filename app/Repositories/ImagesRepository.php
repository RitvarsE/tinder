<?php


namespace App\Repositories;


use App\Models\Image;
use App\Models\ImagesCollection;

interface ImagesRepository
{
    public function upload(Image $image): void;

    public function getAllPicture(int $user_id): ImagesCollection;

    public function getPicture(int $image_id): Image;

    public function deletePicture(Image $image): void;
}