<?php

namespace Source\Controllers;

use Source\Models\Dado;
use Source\Models\Resposta;
use Source\Utils\Csv;
use Source\Utils\Respostas;
use stdClass;

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
      
      // Caso não tenha nenhum pesquisador
      if(!$obPesquisadores) $obPesquisadores = new stdClass();

      echo $this->view->render('app/app', [
         'title' => "Respostas",
         'userId' => $_SESSION['managerUserId'],
         'obPesquisadores' => $obPesquisadores
      ]);
   }

   /**
    * Deleta o pesquisador e todas suas respostas
    *
    * @param array $data
    * @return void
    */
   public function deletar(array $data): void
   {
      // Id do pesquisador
      $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
      $obPesquisador = (new Dado)->find('id = :id', "id=$id")->fetch();
      if(!$obPesquisador){
         setMessage('error', "Não foi encontrado dados desse pesquisador!");   
         $this->router->redirect('app.respostas');
         return;
      }

      // todas respostas
      $obRespostas = (new Resposta)->find('idUsuario = :iu', "iu=$obPesquisador->id")->fetch(true);

      // deleta o pesquisador
      $obPesquisador->destroy();

      if(!$obRespostas){
         setMessage('error', "Todas respostas já foram removidas!");     
         $this->router->redirect('app.respostas');
         return;
      }

      foreach($obRespostas as $obResposta){
         $obResposta->destroy();
      }

      setMessage('sucesso', "Dados da entrevista deletado com sucesso!");
      $this->router->redirect('app.respostas');
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
         'id' => $idPesquisador,
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
      foreach ($dadosPesquisadores as $obPesquisador) {
         $dadosRespostas[$obPesquisador->id] = $this->getRespostasByPesquisador($obPesquisador);
      }

      // Criar arquivo ODS
      $obCsv = (new Csv($dadosPesquisadores, $dadosRespostas))->gerarCsvFile();

      header('Content-Description: File Transfer');
      header('Content-Type: application/force-download');
      header("Content-Disposition: attachment; filename=questionario-" . date('d-m-Y H-i-s') . ".csv");
      echo file_get_contents($obCsv);
   }

   /**
    * Baixa uma planilha do tipo CSV com os dados de um pesquisador em específico
    *
    * @return void
    */
   public function exportarIndividual(array $data): void
   {
      $idPesquisador = filter_Var($data['id'], FILTER_SANITIZE_STRING);
      $obPesquisador = (new Dado)->find('id = :id', "id=$idPesquisador")->fetch();
      $dadosRespostas[$obPesquisador->id] = $this->getRespostasByPesquisador($obPesquisador);

      // Criar arquivo ODS
      $obCsv = (new Csv([$obPesquisador], $dadosRespostas))->gerarCsvFile();

      header('Content-Description: File Transfer');
      header('Content-Type: application/force-download');
      header("Content-Disposition: attachment; filename=questionario-individual-" . date('d-m-Y H-i-s') . ".csv");
      echo file_get_contents($obCsv);
   }

   /**
    * Obtém as respostas a partir de um Objeto do tipo Dado
    *
    * @param Dado $obPesquisador
    * @return array
    */
   private function getRespostasByPesquisador($obPesquisador)
   {
      $respotasOb = (new Resposta)->find('idUsuario = :iu', "iu=$obPesquisador->id")->order('page')->fetch(true);
      $respostasFormatadas = (new Respostas($respotasOb))->simplificarDadosRespostas();

      return $respostasFormatadas;
   }
}
