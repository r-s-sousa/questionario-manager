<?php

/**
 * Rotas GET
 */
$router->namespace("Source\Controllers");
$router->get('/login', 'Login:login', 'login.login');

/**
 * Rotas POST
 */
$router->post('/login', 'Login:loginPost', 'login.post');
