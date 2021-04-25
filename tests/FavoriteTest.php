<?php

namespace Tests;

use App\Models\Favorite;
use PHPUnit\Framework\TestCase;

class FavoriteTest extends TestCase
{

    public function testGetUserId(): void
    {
        $user = new Favorite(4, 2, 1, 5);
        self::assertEquals(4, $user->getUserId());
    }

    public function testGetFavoriteId(): void
    {
        $user = new Favorite(4, 2, 1, 5);
        self::assertEquals(2, $user->getFavoriteId());
    }

    public function testGetFavorite(): void
    {
        $user = new Favorite(4, 2, 1, 5);
        self::assertEquals(1, $user->getFavorite());
    }

    public function testGetId(): void
    {
        $user = new Favorite(4, 2, 1, 5);
        self::assertEquals(5, $user->getId());
    }
}
