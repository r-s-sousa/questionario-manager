<?php

namespace Source\Utils;

/**
 * Geração de arquivos CSV
 */
class Csv
{
   /**
    * Pesquisadores
    *
    * @var array
    */
   private $obPesquisadores;

   /**
    * Respostas dos pesquisadores
    *
    * @var array
    */
   private $obRespostas;

   /**
    * Construtor para geração de arquivo CSV
    *
    * @param array $obPesquisadores
    * @param array $obRespostas
    */
   public function __construct(array $obPesquisadores, array $obRespostas)
   {
      $this->obPesquisadores = $obPesquisadores;
      $this->obRespostas = $obRespostas;
   }

   /**
    * Gera e salva o arquivo CSV com os dados da pesquisa
    *
    * @return string Localização do arquivo gerado
    */
   public function gerarCsvFile(): string
   {
      $dadosCsv = [];

      $cont = 0;
      foreach($this->obPesquisadores as $obPesquisador){
         $respostasDoPesquisador = $this->obRespostas[$obPesquisador->id];
         $nomePesquisador = abreviaNome($obPesquisador->nome);
         foreach($respostasDoPesquisador as $pergunta => $resposta){
            $cont++;
            $dadosCsv[] = [$cont, $nomePesquisador, $resposta['bloco'], $resposta['page'], $pergunta, $resposta['resposta']];
         }
      }

      $path = dirname(__DIR__, 2)."/themes/assets/csv/questionario.csv";

      $fp = fopen($path, 'w');
      fputcsv($fp, ['order', 'pesquisador', 'bloco', 'page', 'pergunta', 'resposta']);

      foreach ($dadosCsv as $linha) {
         fputcsv($fp, $linha);
      }

      fclose($fp);

      return $path;
   }
}
