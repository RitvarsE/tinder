<?php


namespace App\Views;


use App\Repositories\MysqlUsersRepository;
use App\Repositories\UsersRepository;
use App\Services\UsersService;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class TwigView
{
    private Environment $twig;

    public function __construct()
    {
        $db = new MysqlUsersRepository();
        $loader = new FilesystemLoader('../app/Views/');
        $this->twig = new Environment($loader, [
            'auto_reload' => true,
            'debug' => true
        ]);
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addGlobal('session', $_SESSION);

        if (isset($_SESSION['login'])) {
            $this->twig->addGlobal('globalUser', $db->getUser($_SESSION['login']));
        }
    }

    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function render(string $name, array $data = []): string
    {
        return $this->twig->render($name, $data);
    }
}