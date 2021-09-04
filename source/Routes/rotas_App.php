<?php

/**
 * Rotas de GET
 */
$router->group(null);
$router->get("/", "App:respostas", "app.respostas");
$router->get("/logout", "App:logout", "app.logout");
