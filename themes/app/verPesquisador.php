<?php
$this->layout('_theme', ['title' => $title]);
$this->insert('partials/navbar', ['userId' => $userId]);
?>

<div class="col-md-12 text-center">
   <h2>Listagem de respostas</h2>
</div>
<div class="col-md-12">
   <table class="table table-bordered">
      <thead class="thead-dark">
         <tr>
            <th>#</th>
            <th>Questão</th>
            <th>Resposta</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $cont = 0;
         foreach ($obRespostas as $pergunta => $resposta) :
            $cont++;
         ?>
            <tr>
               <td><?= $cont; ?></td>
               <td><?= $pergunta; ?></td>
               <td><?= $resposta; ?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>