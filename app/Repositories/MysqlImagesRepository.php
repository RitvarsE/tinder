<?php


namespace App\Repositories;


use App\Models\Image;
use App\Models\ImagesCollection;
use Medoo\Medoo;
use PDO;

class MysqlImagesRepository implements ImagesRepository
{
    protected Medoo $database;

    public function __construct()
    {
        $pdo = new PDO('mysql:dbname=tinder;host=localhost', 'root', 'kartupelis',
            [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
        $this->database = new Medoo(['pdo' => $pdo, 'database_type' => 'mysql']);
    }

    public function upload(Image $image): void
    {
        $this->database->insert('images', [
            'original_name' => $image->getOriginalName(),
            'path' => $image->getPath(),
            'user_id' => $_SESSION['id']
        ]);
    }

    public function getAllPicture(int $user_id): ImagesCollection
    {
        $images = $this->database->select('images', '*', ['user_id' => $user_id]);
        $imageCollection = new ImagesCollection([]);

        foreach ($images as $image) {
            $imageCollection->add(new Image(
                $image['original_name'],
                $image['path'],
                $image['user_id'],
                $image['image_id']));
        }
        return $imageCollection;
    }

    public function getPicture(int $image_id): Image
    {
        $image = $this->database->get('images', '*', ['image_id' => $image_id]);
        return new Image(
            $image['original_name'],
            $image['path'],
            $image['user_id'],
            $image['image_id']);
    }

    public function deletePicture(Image $image): void
    {

        $this->database->delete('images', ['image_id' => $image->getId()]);

    }
}