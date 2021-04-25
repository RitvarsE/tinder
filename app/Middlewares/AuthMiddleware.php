<?php


namespace App\Middlewares;


use App\Views\TwigView;

class AuthMiddleware implements MiddlewareInterface
{
    public function authorize(): void
    {
        $twig = new TwigView();
        if (isset($_SESSION['login'])) {
            $message = '';
            $redirect = 'matching';
            $timeout = 0;
            echo $twig->render('redirect.twig', compact('message', 'redirect', 'timeout'));
            exit;
        }
    }

}