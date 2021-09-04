<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * DAO - Respostas
 */
class Resposta extends DataLayer
{
   /**
    * Construtor do DAO - Dados 
    */
   public function __construct()
   {
      parent::__construct("respostas", ['idUsuario', 'page', 'bloco', 'respostas']);
   }
}
