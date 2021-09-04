<?php

// Mostra os erros
ini_set('display_errors', true);

// Inicia a sessão
session_start();

// Referências
use CoffeeCode\Router\Router;

// Autoload
require __DIR__ . "/vendor/autoload.php";

// Gestor de rotas
$router = new Router(URL);

// Rotas de LOGIN
require_once __DIR__."/source/Routes/rotas_Login.php";

// Rotas do APP
require_once __DIR__."/source/Routes/rotas_App.php";

// Rotas de error
require_once __DIR__."/source/Routes/rotas_Error.php";

// Executa as rotas
$router->dispatch();

// Caso aconteça algum error de rota
if ($router->error()) $router->redirect('error.error', ['errcode' => $router->error()]);
