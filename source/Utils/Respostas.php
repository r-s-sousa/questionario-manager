<?php

namespace Source\Utils;

/**
 * Utilitário para DAO - Respostas
 */
class Respostas
{
   /**
    * Repostas recebidas a partir do banco de dados
    *
    * @var array
    */
   private $obRespostas;

   /**
    * Construtor da classe
    *
    * @param array $respostas
    */
   public function __construct(array $obRespostas)
   {
      $this->obRespostas = $obRespostas;
   }

   /**
    * A partir de todas respotas cadastradas no banco, simplifica para um único
    * array com pergunta e resposta
    *
    * @return array
    */
   public function simplificarDadosRespostas(): array
   {
      $apenasRespostas = [];

      foreach ($this->obRespostas as $resposta) {

         $respostaDecodificada = json_decode($resposta->respostas, true);
         $bloco = $resposta->bloco;
         $page = $resposta->page;

         foreach ($respostaDecodificada as $key => $respostaDaFila) {
            if ($key == 'blocoId')  continue;
            if ($key == 'page')  continue;
            if ($key == "opcoes") $respostaDaFila = implode(",", $respostaDaFila);
            if ($respostaDaFila == "Outro") continue;
            // Caso a resposta secondaria, seja outro, aparece apenas o valor digitado pelo usuário
            if (count(explode('_', $key)) > 1) {
               $keySeparada = explode('_', $key);
               if ($keySeparada[count($keySeparada) - 1] == "1" && $respostaDaFila == "Outro") continue;
            }

            $apenasRespostas[$key] = ['resposta' => $respostaDaFila, 'bloco' => $bloco, 'page' => $page];
         }
      }

      return $apenasRespostas;
   }
}
