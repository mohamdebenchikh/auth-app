<?php

use App\Controllers\AuthController;
use App\Controllers\ChangePasswordController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\ProfileController;
use App\Core\Application;
use App\Core\Session;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

require "../vendor/autoload.php";

Session::start();

$app = new Application();

$app->get('/', function () {
    return redirect()->to(url('/home'));
});


$app->group(['middleware' => GuestMiddleware::class], function ($app) {
    $app->get('/login', [AuthController::class, 'login']);
    $app->post('/login', [AuthController::class, 'login']);
    $app->get('/register', [AuthController::class, 'register']);
    $app->post('/register', [AuthController::class, 'register']);
});

$app->group(['middleware' => AuthMiddleware::class], function ($app) {
    $app->get('/home', [HomeController::class, 'index']);
    $app->get('/profile', [ProfileController::class, 'index']);
    $app->get('/profile/edit', [ProfileController::class, 'edit']);
    $app->post('/profile/update', [ProfileController::class, 'update']);
    $app->get('/change-password', [ChangePasswordController::class, 'index']);
    $app->post('/change-password/update', [ChangePasswordController::class, 'update']);
    $app->post('/posts', [PostController::class, 'store']);
    $app->post('/logout', [AuthController::class, 'logout']);
});

$app->run();
