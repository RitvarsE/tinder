<?php

namespace Tests;

use App\Models\Image;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testGetProfilePicture(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        $user = new User('ritvars', '123123', 25, 1, $image, 1);
        self::assertEquals($image, $user->getProfilePicture());
        $nullUser = new User('ritvars', '123123', 25, 1, null, 1);
        self::assertEquals(null, $nullUser->getProfilePicture());
    }

    public function testGetAge(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        $user = new User('ritvars', '123123', 25, 1, $image, 1);
        self::assertEquals(25, $user->getAge());
    }

    public function testGetLogin(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        $user = new User('ritvars', '123123', 25, 1, $image, 1);
        self::assertEquals('ritvars', $user->getLogin());
    }

    public function testGetPassword(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        $user = new User('ritvars', '123123', 25, 1, $image, 1);
        self::assertEquals('123123', $user->getPassword());
    }

    public function testGetId(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        $user = new User('ritvars', '123123', 25, 1, $image, 1);
        self::assertEquals(1, $user->getId());
    }

    public function testIsGender(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        $user = new User('ritvars', '123123', 25, 1, $image, 1);
        self::assertTrue(true, $user->isGender());
    }
}
