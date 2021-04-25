<?php

use App\Controllers\HomeController;
use App\Controllers\ImageController;
use App\Controllers\UserController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\notAuthMiddleware;

return [
    UserController::class . '@dislike' => [notAuthMiddleware::class],
    UserController::class . '@like' => [notAuthMiddleware::class],
    ImageController::class . '@deletePicture' => [notAuthMiddleware::class],
    UserController::class . '@setMainPicture' => [notAuthMiddleware::class],
    ImageController::class . '@uploaded' => [notAuthMiddleware::class],
    UserController::class . '@favorites' => [notAuthMiddleware::class],
    UserController::class . '@logout' => [notAuthMiddleware::class],
    UserController::class . '@matching' => [notAuthMiddleware::class],
    UserController::class . '@register' => [AuthMiddleware::class],
    UserController::class . '@registration' => [AuthMiddleware::class],
    UserController::class . '@profile' => [notAuthMiddleware::class],
    ImageController::class . '@upload' => [notAuthMiddleware::class],
    ImageController::class . '@gallery' => [notAuthMiddleware::class],
    HomeController::class . '@index' => [AuthMiddleware::class]
];