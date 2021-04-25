<?php

namespace Tests;

use App\Models\Image;
use App\Models\ImagesCollection;
use PHPUnit\Framework\TestCase;

class ImagesCollectionTest extends TestCase
{

    public function testIsEmpty(): void
    {
        $imageCollection = new ImagesCollection([]);
        self::assertTrue(true, $imageCollection->isEmpty());
    }

    public function testGetImages(): void
    {
        $image = new Image('avatar.png', '/storage/', 5, 2);
        $image2 = new Image('avatar.png', '/storage/', 5, 2);
        $imageCollection = new ImagesCollection([$image, $image2]);
        self::assertEquals([$image, $image2], $imageCollection->getImages());
    }
}
