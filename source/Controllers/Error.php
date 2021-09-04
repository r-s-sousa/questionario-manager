<?php

namespace Source\Controllers;

/**
 * Classe responsável por gerir erros de rotas
 */
class Error extends Controller
{
   /**
    * Construtor do controlador de erros
    *
    * @param Router $router
    */
   public function __construct($router)
   {
      parent::__construct($router);
   }

   /**
    * Página de error
    *
    * @return void
    */
   public function Error($data)
   {
      echo $this->view->render("main/error", [
         'title' => "Error {$data['errcode']} | " . SITE,
         'error' => $data['errcode']
      ]);
   }
}
