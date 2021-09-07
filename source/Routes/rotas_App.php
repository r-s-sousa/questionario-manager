<?php

/**
 * Rotas de GET
 */
$router->group(null);
$router->get("/", "App:respostas", "app.respostas");
$router->get("/exportar", "App:exportar", "app.exportar");
$router->get("/exportar-individual/{id}", "App:exportarIndividual", "app.exportarIndividual");
$router->get("/pesquisador/{id}", "App:verPesquisador", "app.verPesquisador");
$router->get("/deletar/{id}", "App:deletar", "app.deletar");
$router->get("/logout", "App:logout", "app.logout");
