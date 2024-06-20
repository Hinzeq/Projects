<?php

declare(strict_types=1);

include_once "Router.php";
include_once __DIR__ . "/../controllers/Controller.php";
include_once __DIR__ . '/../exceptions/PageNotFoundException.php';

$router = new Router();

$router->addRoute('GET', '/blogs', function () {
    echo Controller::blogs();
});

$router->addRoute('GET', '/blogs/{id}', function ($id) {
    echo Controller::blog($id);
});

$router->addRoute('GET', '/blogs/{id}/test/{test}', function ($id, $test) {
    echo Controller::test(intval($id), $test);
});

$router->matchRoute();
