<?php


namespace App\Controllers;


use App\Services\UsersService;
use App\Views\TwigView;

class UserController
{
    private UsersService $usersService;
    private TwigView $twig;

    public function __construct(UsersService $usersService, TwigView $twig)
    {
        $this->usersService = $usersService;
        $this->twig = $twig;
    }

    public function login(): string
    {
        $redirect = '';
        $message = 'Login Successful';
        $timeout = 1;
        if ($this->usersService->verifyLogin($_POST['login'], $_POST['password'])) {
            $_SESSION['login'] = $_POST['login'];
            return $this->twig->render('success.twig', compact('redirect', 'message', 'timeout'));
        }
        $message = 'Incorrect Login/Password';
        return $this->twig->render('error.twig', compact('redirect', 'timeout', 'message'));
    }

    public function logout(): string
    {
        session_destroy();
        $redirect = '';
        $message = 'Logout Successful';
        $timeout = 1;
        return $this->twig->render('success.twig', compact('redirect', 'message', 'timeout'));
    }

    public function registration(): string
    {
        return $this->twig->render('registration.twig');
    }

    public function register(): string
    {
        $redirect = '';
        $message = 'Login Successful';
        $timeout = 1;
        $error = 'problem';
        if ($this->usersService->create($_POST)) {
            return $this->twig->render('success.twig', compact('redirect', 'message', 'timeout'));
        }
        return $this->twig->render('error.twig', compact('redirect', 'timeout', 'error'));
    }

    public function profile(): string
    {
        $user = $this->usersService->getUser($_SESSION['login']);

        return $this->twig->render('profile.twig', compact('user'));
    }

    public function setMainPicture(): string
    {
        $this->usersService->setMainPicture($_SESSION['login'], $_POST['main']);
        $message = 'Profile picture changed';
        $redirect = 'profile';
        $timeout = 1;
        return $this->twig->render('redirect.twig', compact('message', 'redirect', 'timeout'));
    }

    public function matching(): string
    {

        $match = $this->usersService->matching();
        if ($match->isEmpty()) {
            $match = null;
            $message = 'There is no more matches for you! :(';
            $redirect = 'favorites';
            $timeout = 1;
            return $this->twig->render('redirect.twig', compact('message', 'redirect', 'timeout'));
        } else {
            $match = $match->getUsers()[0];
        }
        return $this->twig->render('matching.twig', compact('match'));
    }

    public function favorites(): string
    {
        $user = $this->usersService->getUser($_SESSION['login']);
        $favorites = $this->usersService->favorites($user);
        if ($favorites !== null) {
            $favorites = $favorites->getUsers();
        }
        return $this->twig->render('favorites.twig', compact('favorites'));
    }

    public function like(): void
    {
        $this->usersService->like($_SESSION['login'], $_POST['like']);
        header('refresh:0;url=/matching');
    }

    public function dislike(): void
    {
        $this->usersService->dislike($_SESSION['login'], $_POST['dislike']);
        header('refresh:0;url=/matching');
    }

}