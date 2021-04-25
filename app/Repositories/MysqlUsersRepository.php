<?php


namespace App\Repositories;


use Tests\Favorite;
use Tests\Image;
use Tests\User;
use Tests\UsersCollection;
use InvalidArgumentException;
use Medoo\Medoo;
use PDO;


class MysqlUsersRepository implements UsersRepository
{
    protected Medoo $database;

    public function __construct()
    {
        $pdo = new PDO(
            'mysql:dbname=tinder;host=localhost', 'root', 'kartupelis',
            [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
        $this->database = new Medoo(['pdo' => $pdo, 'database_type' => 'mysql']);
    }

    public function verifyLogin(string $login, string $password): bool
    {
        if ($this->hasUser($login)) {
            $user = $this->getUser($login);
            return password_verify($password, $user->getPassword());
        }
        return false;
    }

    public function hasUser(string $login): bool
    {
        return $this->database->has('users', ['login' => $login]);
    }

    public function create(User $user): void
    {
        $this->database->insert('users', [
            'login' => $user->getLogin(),
            'password' => $user->getPassword(),
            'age' => $user->getAge(),
            'gender' => $user->isGender() === true ? 1 : 0
        ]);
    }

    public function like(Favorite $favorite): void
    {
        $this->database->insert('favorites', [
            'user_id' => $favorite->getUserId(),
            'favorite_id' => $favorite->getFavoriteId(),
            'favorite' => $favorite->getFavorite()]);
    }

    public function dislike(Favorite $favorite): void
    {
        $this->database->insert('favorites', [
            'user_id' => $favorite->getUserId(),
            'favorite_id' => $favorite->getFavoriteId(),
            'favorite' => $favorite->getFavorite()]);
    }

    public function setMainPicture(User $user, Image $image): void
    {
        $this->database->update('users', ['profile_picture' => $image->getId()], ['id' => $user->getId()]);
    }

    public function getUser(string $login): User
    {
        $user = $this->database->get(
            'users',
            ['[>]images' => ['profile_picture' => 'image_id']],
            '*', ['login' => $login]);

        if ($user === null) {
            throw new InvalidArgumentException('User not Found');
        }

        $image = new Image(
            $user['original_name'],
            $user['path'],
            $user['user_id'],
            $user['image_id']);

        return new User(
            $user['login'],
            $user['password'],
            $user['age'],
            $user['gender'],
            $image,
            $user['id']
        );
    }


    public function getUsers(): UsersCollection
    {
        $usersCollection = new UsersCollection([]);
        $users = $this->database->select(
            'users',
            ['[>]images' => ['profile_picture' => 'image_id']],
            '*');
        foreach ($users as $user) {
            $image = new Image(
                $user['original_name'],
                $user['path'],
                $user['user_id'],
                $user['image_id']);

            $usersCollection->add(new User(
                $user['login'],
                $user['password'],
                $user['age'],
                $user['gender'],
                $image,
                $user['id']));
        }
        return $usersCollection;
    }

    public function getFavorites(User $user, int $status = null): UsersCollection
    {
        if ($status === 0 || $status === 1) {
            $favorites = $this->database->select(
                'favorites',
                ['[>]users' => ['favorite_id' => 'id']],
                '*',
                ['user_id' => $user->getId(),
                    'favorite' => $status]);
        } else {
            $favorites = $this->database->select(
                'favorites',
                ['[>]users' => ['favorite_id' => 'id']],
                '*',
                ['user_id' => $user->getId()]);
        }
        $usersCollection = new UsersCollection([]);

        foreach ($favorites as $favorite) {
            $usersCollection->add($this->getUser($favorite['login']));
        }
        return $usersCollection;
    }

}