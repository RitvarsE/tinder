<?php
require_once "../vendor/autoload.php";


session_start();
//Container
$container = new League\Container\Container;

$container->add(StockRepository::class, MySQLStockRepository::class)->addArgument(QuoteRepository::class);
$container->add(StockService::class, StockService::class)->addArgument(StockRepository::class);

$container->add(UsersRepository::class, MySQLUsersRepository::class);
$container->add(UsersService::class, UsersService::class)->addArgument(UsersRepository::class);

$container->add(QuoteRepository::class, FinnhubQuoteRepository::class)
    ->addArgument(new FilesystemCache('../storage/cache/'));

$container->add(MainService::class, MainService::class)
    ->addArguments([UsersService::class, StockService::class]);

$container->add(HomeController::class, HomeController::class)->addArgument(MainService::class);
$container->add(AccountController::class, AccountController::class)->addArgument(MainService::class);


//Routes
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute(['GET'], '/', [HomeController::class, 'login']);
    $r->addRoute(['POST'], '/', [HomeController::class, 'index']);
});
//
$middlewares = [
    AccountController::class . '@account' => [AuthMiddleware::class],
    AccountController::class . '@stock' => [AuthMiddleware::class],

];
//
// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        require_once '../app/Views/NothingView.twig';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = $handler;
        $controllerMiddlewares = [];
        $middlewareKey = $controller . '@' . $method;
        $controllerMiddlewares = $middlewares[$middlewareKey] ?? [];

        foreach ($controllerMiddlewares as $controllerMiddleware) {
            (new $controllerMiddleware)->authorize();
        }

        echo ($container->get($controller))->$method($vars);
        break;
}