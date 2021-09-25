<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Link extends DataLayer
{
   public function __construct()
   {
      parent::__construct("pesquisadores_link", ['pesquisador', 'idLink', 'linkAcessado'], 'id', false);
   }
}
