<?php

use App\Controllers\HomeController;
use App\Controllers\ImageController;
use App\Controllers\UserController;
use App\Repositories\ImagesRepository;
use App\Repositories\MysqlImagesRepository;
use App\Repositories\MysqlUsersRepository;
use App\Repositories\UsersRepository;
use App\Services\ImagesService;
use App\Services\UsersService;
use App\Views\TwigView;

$container = new League\Container\Container;

$container->add(TwigView::class);

$container->add(HomeController::class)->addArgument(TwigView::class);

$container->add(UsersRepository::class, MysqlUsersRepository::class);
$container->add(ImagesRepository::class, MysqlImagesRepository::class);

$container->add(UsersService::class, UsersService::class)
    ->addArguments([UsersRepository::class, ImagesRepository::class]);

$container->add(UserController::class)->addArguments([UsersService::class, TwigView::class]);

$container->add(ImagesService::class, ImagesService::class)->addArgument(ImagesRepository::class);
$container->add(ImageController::class)->addArguments([ImagesService::class, TwigView::class, UsersService::class]);

return $container;