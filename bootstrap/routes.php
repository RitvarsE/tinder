<?php

use App\Controllers\HomeController;
use App\Controllers\ImageController;
use App\Controllers\UserController;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/matching', [UserController::class, 'matching']],
    ['GET', '/register', [UserController::class, 'registration']],
    ['POST', '/register', [UserController::class, 'register']],
    ['POST', '/', [UserController::class, 'login']],
    ['GET', '/logout', [UserController::class, 'logout']],
    ['GET', '/profile', [UserController::class, 'profile']],
    ['GET', '/favorites', [UserController::class, 'favorites']],
    ['GET', '/upload', [ImageController::class, 'upload']],
    ['POST', '/upload', [ImageController::class, 'uploaded']],
    ['GET', '/gallery', [ImageController::class, 'gallery']],
    ['POST', '/gallery/setmain/{id:\d+}', [UserController::class, 'setMainPicture']],
    ['POST', '/gallery/delete/{id:\d+}', [ImageController::class, 'deletePicture']],
    ['POST', '/like/{id:\d+}', [UserController::class, 'like']],
    ['POST', '/dislike/{id:\d+}', [UserController::class, 'dislike']]
];