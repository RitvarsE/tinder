<?php


namespace App\Services;


use Tests\Favorite;
use Tests\User;
use Tests\UsersCollection;
use App\Repositories\ImagesRepository;
use App\Repositories\UsersRepository;
use App\Validators\RegistrationValidation;

class UsersService
{
    private UsersRepository $usersRepository;
    private ImagesRepository $imagesRepository;

    public function __construct(UsersRepository $usersRepository, ImagesRepository $imagesRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->imagesRepository = $imagesRepository;
    }

    public function verifyLogin(string $login, string $password): bool
    {
        if ($this->hasUser($login)) {
            $_SESSION['id'] = $this->usersRepository->getUser($login)->getId();

            return $this->usersRepository->verifyLogin($login, $password);
        }
        return false;
    }

    public function hasUser(string $login): bool
    {
        return $this->usersRepository->hasUser($login);
    }

    public function create(array $postData): bool
    {
        $validation = (new RegistrationValidation($postData))->validateRegistration();
        if ($this->hasUser($postData['login'])) {
            return false;
        } else if ($validation) {
            $user = new User(
                $postData['login'],
                password_hash($postData['password'], PASSWORD_BCRYPT),
                $postData['age'],
                $postData['gender']
            );
            $this->usersRepository->create($user);
            return true;
        }
        return false;
    }

    public function getUser(string $login): User
    {
        return $this->usersRepository->getUser($login);
    }

    public function setMainPicture(string $login, int $image_id): void
    {
        $user = $this->usersRepository->getUser($login);
        $image = $this->imagesRepository->getPicture($image_id);

        $this->usersRepository->setMainPicture($user, $image);
    }


    public function getUsers(): UsersCollection
    {
        return $this->usersRepository->getUsers();
    }


    public function like(string $login, int $favorite_id)
    {
        $favorite = new Favorite($this->getUser($login)->getId(), $favorite_id, 1);

        $this->usersRepository->like($favorite);
    }

    public function dislike(string $login, int $favorite_id)
    {
        $favorite = new Favorite($this->getUser($login)->getId(), $favorite_id, 0);

        $this->usersRepository->dislike($favorite);
    }

    public function matching(): UsersCollection
    {
        $userProfile = $this->getUser($_SESSION['login']);
        $users = $this->getUsers()->getUsers();
        $favorites = new UsersCollection([]);
        $userFavorites = $this->usersRepository->getFavorites($userProfile);

        if ($userFavorites->isEmpty()) {
            foreach ($users as $user) {
                if ($user->isGender() !== $userProfile->isGender()) {
                    $favorites->add($user);
                }
            }
        } else {
            foreach ($users as $user) {
                if (!in_array($user, $userFavorites->getUsers()) && $user->isGender() !== $userProfile->isGender()) {
                    $favorites->add($user);
                }
            }
        }
        return $favorites;
    }

    public function favorites(User $user): ?UsersCollection
    {
        $favoritesCollection = new UsersCollection([]);
        $favorites = $this->usersRepository->getFavorites($user, 1);
        if ($favorites->isEmpty()) {
            return null;
        }
        foreach ($favorites->getUsers() as $favorite) {
            $favoritesCollection->add($this->getUser($favorite->getLogin()));
        }
        return $favoritesCollection;
    }
}