<?php


namespace App\Controllers;


use App\Services\ImagesService;
use App\Services\UsersService;
use App\Views\TwigView;

class ImageController
{
    private ImagesService $imagesService;
    private TwigView $twig;
    private UsersService $usersService;

    public function __construct(ImagesService $imagesService, TwigView $twig, UsersService $usersService)
    {
        $this->imagesService = $imagesService;
        $this->twig = $twig;
        $this->usersService = $usersService;
    }

    public function upload(): string
    {
        return $this->twig->render('upload.twig');
    }

    public function uploaded(): string
    {
        $timeout = 1;
        $redirect = 'gallery';
        if ($this->imagesService->upload($_FILES['image'])) {
            $message = $_SESSION['_flash']['success'];
            return $this->twig->render('success.twig', compact('timeout', 'message', 'redirect'));
        }
        $message = $_SESSION['_flash']['error'];
        return $this->twig->render('error.twig', compact('timeout', 'message', 'redirect'));
    }

    public function gallery(): string
    {
        $pictures = $this->imagesService->getAllPicture($_SESSION['id']);
        if ($pictures->isEmpty()) {
            $message = 'No pictures, upload new one!';
            $redirect = 'upload';
            $timeout = 1;
            return $this->twig->render('redirect.twig', compact('message', 'redirect', 'timeout'));
        } else {
            $pictures = $pictures->getImages();
        }
        $user = $this->usersService->getUser($_SESSION['login']);
        return $this->twig->render('gallery.twig', compact('pictures', 'user'));
    }

    public function deletePicture(): string
    {
        $this->imagesService->deletePicture($_POST['delete']);
        $message = 'Deleting image';
        $timeout = 1;
        $redirect = 'gallery';
        return $this->twig->render('success.twig', compact('timeout', 'message', 'redirect'));
    }

}