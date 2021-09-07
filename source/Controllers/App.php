<?php

namespace Source\Controllers;

use Source\Models\Dado;
use Source\Models\Resposta;
use Source\Models\User;
use Source\Utils\Csv;
use Source\Utils\Respostas;

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
      unset($_SESSION['managerUserId']);
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
         'userId' => $_SESSION['managerUserId'],
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

      // Converte para pergunta e resposta
      $respostasArray = (new \Source\Utils\Respostas($obRespostas))->simplificarDadosRespostas();

      echo $this->view->render('app/verPesquisador', [
         'title' => "Gabarito",
         'userId' => $_SESSION['managerUserId'],
         'obRespostas' => $respostasArray
      ]);
   }

   /**
    * Baixa uma planilha do tipo CSV com os dados do banco de dados
    *
    * @return void
    */
   public function exportar(): void
   {
      $dadosPesquisadores = (new Dado)->find()->fetch(true);
      $dadosRespostas = [];
      foreach($dadosPesquisadores as $obPesquisador){
         $respotasOb = (new Resposta)->find('idUsuario = :iu', "iu=$obPesquisador->id")->order('page')->fetch(true);
         $respostasFormatadas = (new Respostas($respotasOb))->simplificarDadosRespostas();
         $dadosRespostas[$obPesquisador->id] = $respostasFormatadas;
      }

      // Criar arquivo ODS
      $obCsv = (new Csv($dadosPesquisadores, $dadosRespostas))->gerarCsvFile();

      header('Content-Description: File Transfer');
      header('Content-Type: application/force-download');
      header("Content-Disposition: attachment; filename=questionario-".date('d-m-Y H-i-s').".csv");
      echo file_get_contents($obCsv);
   }
   
}
