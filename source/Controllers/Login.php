<?php

namespace Source\Controllers;

use Source\Models\User;
use Source\Utils\Email;

/**
 * Controlador de rotas de login
 */
class Login extends Controller
{
   /**
    * Construct - start router for login
    *
    * @param $router
    */
   public function __construct($router)
   {
      parent::__construct($router);
   }

   /**
    * Formulário de login
    */
   public function login()
   {
      echo $this->view->render('login/login', [
         'title' => "Login | " . SITE
      ]);
   }

   /**
    * Faz o login em si
    *
    * @param array $data
    * @return void
    */
   public function loginPost($data)
   {
      $data = filter_var_array($data, FILTER_SANITIZE_STRING);
      $email = $data['email'];

      // VERIFICA SE EMAIL EXISTE NO BANCO DE DADOS
      $emailOb = (new User)->find('email = :e', "e=$email")->fetch(true);

      // SE EMAIL NÃO EXISTE
      if (!count($emailOb)) {
         setMessage('error', "<strong>Dados</strong> incorretos!");
         $this->router->redirect('login.login');
         return;
      }

      // SE A SENHA NÃO CORRESPONDER COM A SENHA CADASTRADA NO BANCO DE DADOS
      if (!password_verify($data['password'], $emailOb[0]->password)) {
         setMessage('error', "<strong>Dados</strong> incorretos!");
         $this->router->redirect('login.login');
         return;
      }

      // Define o ID do usuário na sessão
      $_SESSION['userId'] = $emailOb[0]->id;

      // REDIRECIONA PARA A PÁGINA INICIAL DO APLICATIVO
      $this->router->redirect('app.respostas');
      return;
   }
}
