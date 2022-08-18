<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\Controllers\ArticleController@latNews');
    $r->addRoute('GET', '/tech', 'App\Controllers\ArticleController@index');
    $r->addRoute('GET', '/sports', 'App\Controllers\ArticleController@sports');
    $r->addRoute('GET', '/business', 'App\Controllers\ArticleController@business');
    $r->addRoute('GET', '/articles/create', 'App\Controllers\ArticleController@create');
    $r->addRoute('POST', '/articles', 'App\Controllers\ArticleController@store');
    $r->addRoute('GET', '/my-articles', 'App\Controllers\ArticleController@show');
    $r->addRoute('GET', '/name-day', 'App\Controllers\NameDayController@show');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        var_dump("not found");
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        var_dump("method not allowed");
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        /** @var \App\View */

        [$controller, $method] = explode("@", $handler);

        $container = new DI\Container();

    if($method == "show") {
        $container->set(\App\Repositories\ArticlesRepository::class, DI\create(\App\Repositories\MyNews::class));
    }elseif ($method == "index"){
        $container->set(\App\Repositories\ArticlesRepository::class, DI\create(\App\Repositories\NewsApiArticleRepository::class));
    }elseif ($method == "sports"){
        $container->set(\App\Repositories\ArticlesRepository::class, DI\create(\App\Repositories\SportsRepositoy::class));
    }elseif ($method == "business"){
        $container->set(\App\Repositories\ArticlesRepository::class, DI\create(\App\Repositories\BusinessRepository::class));
    }elseif ($method == "latNews"){
        $container->set(\App\Repositories\ArticlesRepository::class, DI\create(\App\Repositories\TopNewsRepository::class));
    }


        $loader = new Twig\Loader\FilesystemLoader('app/Views');
        $twig = new Twig\Environment($loader);
        $template = $twig->load('articles.twig');
        if($method == 'create'){
            $template = $twig->load('create-article.html');
            $container->set(\App\Repositories\ArticlesRepository::class, DI\create(\App\Repositories\AddArticle::class));
        }
        elseif($method == 'store'){
            $template = $twig->load('create-article.html');
            $container->set(\App\Repositories\ArticlesRepository::class, DI\create(\App\Repositories\AddArticle::class));
        }

        $view = ($container->get($controller))->$method();

        echo $template->render($view->getData());

        break;
}