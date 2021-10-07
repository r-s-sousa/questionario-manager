<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
   <title>Dados de acesso dos pesquisadores</title>   
</head>

<body>
   <div class="col-md-12 mb-2 text-center">
      <h2>Acesso de Pesquisadores</h2>
      <hr>
   </div>

   <div class="col-md-12 text-center">
      <table class="table table-bordered" id="tabela">
         <thead class="thead-dark">
            <tr>
               <th style="width: 10px;">#</th>
               <th style="">Pesquisador</th>
               <th style="width: 10px;">Acessado</th>
               <th style="width: 160px">Consentimento</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($obPesquisadores as $pesquisador) : ?>
               <tr>
                  <td><?= $pesquisador->idLink; ?></td>
                  <td><?= $pesquisador->pesquisador; ?></td>
                  <td>
                     <?php if ($pesquisador->linkAcessado) : ?>
                        Sim
                     <?php else : ?>
                        Não
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if ($pesquisador->termoConsentimento == null) : ?>
                        Não respondido
                     <?php elseif ($pesquisador->termoConsentimento == 0) : ?>
                        Não aceito
                     <?php elseif ($pesquisador->termoConsentimento == 1) : ?>
                        Aceito
                     <?php endif; ?>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
</body>

</html>  