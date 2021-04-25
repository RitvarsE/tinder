<?php

namespace Tests;

use App\Models\User;
use App\Models\UsersCollection;
use PHPUnit\Framework\TestCase;

class UsersCollectionTest extends TestCase
{

    public function testIsEmpty()
    {
        $user = new User('ritvars', '123123', 25, 1, null, 1);
        $userCollection = new UsersCollection([$user]);
        self::assertFalse(false, $userCollection->isEmpty());
        $trueUserCollection = new UsersCollection([]);
        self::assertTrue(true, $trueUserCollection->isEmpty());
    }

    public function testGetUsers()
    {
        $user = new User('ritvars', '123123', 25, 1, null, 1);
        $userCollection = new UsersCollection([$user]);
        self::assertEquals([$user], $userCollection->getUsers());
    }
}
