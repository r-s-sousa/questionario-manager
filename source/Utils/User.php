<?php

namespace Source\Utils;

/**
 * Utilitario da tabela User
 */
class User
{  
   /**
    * Valida a sessão do usuário
    *
    * @return bool
    */
   public static function verificaSeEstaLogado(): bool
   {
      // Verifica se existe a sessão
      if(!isset($_SESSION['managerUserId'])) return false;

      $userId = $_SESSION['managerUserId'];

      // Verifica se o usuário com esse Id existe no banco de dados
      $obUser = (new \Source\Models\User)->findById($userId);

      if(!$obUser) return false;

      return true;
   }
}