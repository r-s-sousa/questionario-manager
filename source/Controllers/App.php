<?php

namespace Source\Controllers;

use Source\Models\Dado;
use Source\Models\Resposta;
use Source\Models\User;

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
      // Pega todos pesquisadores
      $obPesquisadores = (new Dado)->find()->fetch(true);

      echo $this->view->render('app/app', [
         'title' => "Respostas",
         'userId' => $_SESSION['userId'],
         'obPesquisadores' => $obPesquisadores
      ]);
   }

   /**
    * Apresenta o gabarito do pesquisador
    *
    * @param array $data
    * @return void
    */
   public function verPesquisador(array $data): void
   {
      $idPesquisador = filter_Var($data['id'], FILTER_SANITIZE_STRING);
      $obPesquisador = (new Dado)->find('id = :id', "id=$idPesquisador")->fetch();

      if (!$obPesquisador) {
         setMessage('error', "Pesquisador não encontrado!");
         $this->router->redirect('app.respostas');
         return;
      }

      $obRespostas = (new Resposta)->find('idUsuario = :ui', "ui=$obPesquisador->id")->order('page')->fetch(true);

      if (!$obRespostas) {
         setMessage('error', "Pesquisador não respondeu o formulário!");
         $this->router->redirect('app.respostas');
         return;
      }

      $apenasRespostas = [];

      foreach ($obRespostas as $resposta) {

         $respostaDecodificada = json_decode($resposta->respostas, true);

         foreach ($respostaDecodificada as $key => $respostaDaFila) {
            if ($key == 'blocoId' || $key == 'page') continue;
            if ($key == "opcoes") $respostaDaFila = implode(",", $respostaDaFila);

            // Caso a resposta secondaria, seja outro, aparece apenas o valor digitado pelo usuário
            if(count(explode('_', $key)) > 1){
               $keySeparada = explode('_', $key);
               if($keySeparada[count($keySeparada)-1] == "1" && $respostaDaFila == "Outro") continue;
            }
            
            $apenasRespostas[$key] = $respostaDaFila;
         }
      }

      echo $this->view->render('app/verPesquisador', [
         'title' => "Gabarito",
         'userId' => $_SESSION['userId'],
         'obRespostas' => $apenasRespostas
      ]);
   }
}
