<?php


namespace App\Services;


use App\Models\Image;
use App\Models\ImagesCollection;
use App\Repositories\ImagesRepository;
use App\Validators\ImageValidation;
use Intervention\Image\ImageManager;

class ImagesService
{
    private ImagesRepository $imagesRepository;
    private ImageManager $imageManager;

    public function __construct(ImagesRepository $imagesRepository)
    {
        $this->imagesRepository = $imagesRepository;
        $this->imageManager = new ImageManager(['driver' => 'gd']);
    }

    public function createPath(array $file): string
    {
        $cryptFileName = crypt($file['name'], 'rl') . time();

        $firstFolder = substr($cryptFileName, 2, 2);
        $secondFolder = substr($cryptFileName, 4, 2);

        if (!file_exists("../storage/images/$firstFolder/$secondFolder")) {
            mkdir("../storage/images/$firstFolder/$secondFolder", 0755, true);
        }
        return "../storage/images/$firstFolder/$secondFolder/$cryptFileName." . $this->getExtension($file['type']);
    }


    public function upload(array $file): bool
    {
        $imageValidation = (new ImageValidation($file))->fileValidation();
        $newName = $this->createPath($file);

        if ($imageValidation) {
            $imageToDatabase = new Image(
                $file['name'],
                substr($newName, 10),
                $_SESSION['id']
            );

            $this->imageManager->make($file['tmp_name'])->resize(500, 333)->save($newName);

            $this->imagesRepository->upload($imageToDatabase);

            return true;
        }
        return false;
    }

    public function getExtension(string $fileType): string
    {
        return substr($fileType, strpos($fileType, "/") + 1);
    }

    public function getAllPicture(int $user_id): ImagesCollection
    {

        return $this->imagesRepository->getAllPicture($user_id);
    }

    public function picture(int $image_id): Image
    {
        return $this->imagesRepository->getPicture($image_id);
    }

    public function deletePicture(int $image_id): void
    {
        $picture = $this->picture($image_id);
        $this->imagesRepository->deletePicture($picture);
        $secondFolder = '../storage' . substr($picture->getPath(), 0, 14);
        $firstFolder = '../storage' . substr($picture->getPath(), 0, 11);

        unlink('../storage' . $picture->getPath());

        if (count(scandir($secondFolder)) <= 2) {
            rmdir($secondFolder);
        }
        if (count(scandir($firstFolder)) <= 2) {
            rmdir($firstFolder);
        }
    }
}