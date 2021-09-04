<?php

namespace Source\Controllers;

/**
 * Controlador do APP
 */
class App extends Controller
{
   /**
    * Construtor do controlador do APP
    *
    * @param Router $router
    */
   public function __construct($router)
   {
      parent::__construct($router);

      // Verifica se está logado
      if (!\Source\Utils\User::verificaSeEstaLogado()) {
         setMessage('error', 'Logue-se 1º');
         $this->router->redirect('login.login');
      }
   }

   /**
    * Remove a sessão do usuário
    *
    * @return void
    */
   public function logout(): void
   {
      unset($_SESSION['userId']);
      $this->router->redirect('login.login');
      return;
   }

   /**
    * Página inicial do APP
    *
    * @return void
    */
   public function respostas(): void
   {
      echo $this->view->render('app/app', ['title' => "Respostas", 'userId' => $_SESSION['userId']]);
   }
}
