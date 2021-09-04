<?php

/**
 * Rotas GET
 */
$router->group("error");
$router->get("/{errcode}", "Error:error", "error.error");
