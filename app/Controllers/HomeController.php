<?php

namespace App\Controllers;

use App\Views\TwigView;

class HomeController
{
    private TwigView $twig;

    public function __construct(TwigView $twig)
    {
        $this->twig = $twig;
    }

    public function index(): string
    {
        return $this->twig->render('home.twig');
    }


}