<?php

/**
 * Abrevia o nome da pessoa, para pegar apenas o 1º e último nome
 * 
 * @param string $nomeCompleto nome completo
 * @return string nome simplificado
 */
function abreviaNome(string $nomeCompleto): string
{
   $nomeSplit = explode(' ', $nomeCompleto);
   if (count($nomeSplit) > 1) return $nomeSplit[0] . " " . $nomeSplit[count($nomeSplit) - 1];
   else return $nomeCompleto;
}

/**
 * Apresenta todos argumentos passados de uma 
 * forma bem atrativa
 *
 * @param mixed $args Finaliza o site após apresentar os dados
 * @return void
 */
function dd($args)
{
   echo "<pre>";
   var_dump($args);
   echo "</pre>";

   die();
}

/**
 * Retorna a url completa do projeto, concatenada do que o usuário
 * passar no parâmetro url
 *
 * @param string $url Url a ser concatenada a url base do site
 * @return string url completa
 */
function url($url = "")
{
   if ($url == "") {
      return URL . "/";
   }

   return URL . "/$url";
}

/**
 * Procura os arquivos dentro da pasta assets
 *
 * @param string $path
 * @return string
 */
function asset($path)
{
   return URL . "/themes/assets/{$path}";
}

/**
 * Adiciona na sessão uma chave com a mensagem a ser apresentar
 *
 * @param string $type
 * @param string $message
 * @return void
 */
function setMessage($type, $message)
{
   // Inicia a sessão
   if (!isset($_SESSION)) session_start();

   // Muda a sessão em si
   switch ($type) {
      case "sucesso":
         $_SESSION['mensagem'] = $message;
         break;
      case "error":
         $_SESSION['error'] = $message;
         break;
      default:
         break;
   }
}
