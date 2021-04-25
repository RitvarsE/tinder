<?php


namespace App\Middlewares;


use App\Views\TwigView;

class notAuthMiddleware implements MiddlewareInterface
{

    public function authorize(): void
    {
        $twig = new TwigView();
        if (!isset($_SESSION['login'])) {
            $message = 'You must login, to access this page. Redirecting to Login page.';
            $redirect = '';
            $timeout = 2;
            echo $twig->render('redirect.twig', compact('message', 'redirect', 'timeout'));
            exit;
        }
    }

}