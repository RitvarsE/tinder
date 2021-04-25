<?php

require_once "../vendor/autoload.php";

session_start();
require_once '../bootstrap/router.php';
if ('GET' === $_SERVER['REQUEST_METHOD'] && isset($_SESSION['_flash'])) {
    unset($_SESSION['_flash']);
}