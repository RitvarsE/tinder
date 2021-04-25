<?php

namespace Tests;

use App\Models\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{

    public function testGetPath(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        self::assertEquals('avatar.png', $image->getOriginalName());
    }

    public function testGetUserId(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        self::assertEquals(5, $image->getUserId());
    }

    public function testGetId(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        self::assertEquals(2, $image->getId());
    }

    public function testGetOriginalName(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        self::assertEquals('/storage/', $image->getPath());
    }
}
