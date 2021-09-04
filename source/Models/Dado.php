<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * DAO - Dados
 */
class Dado extends DataLayer
{
   /**
    * Construtor do DAO - Dados 
    */
   public function __construct()
   {
      parent::__construct("dados", ['email', 'nome', 'termosAcepted_at']);
   }
}
