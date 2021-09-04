<?php
$this->layout('_theme', ['title' => $title]);
$this->insert('partials/navbar', ['userId' => $userId]);
?>

<div class="col-md-12 text-center">
   <h2>Listagem de respostas</h2>
</div>
<div class="col-md-12">
   <table class="table table-bordered" id='tabela'>
      <thead class="thead-dark">
         <tr>
            <th>Bloco</th>
            <th>Página</th>
            <th>Questão</th>
            <th>Resposta</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($obRespostas as $key => $questao) : ?>
            <tr>
               <td><?= $questao['bloco']; ?></td>
               <td><?= $questao['page']; ?></td>
               <td><?= $key; ?></td>
               <td><?= $questao['resposta']; ?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>

<!-- filter table jquery -->
<?php $this->start("styles"); ?>
<?php $this->insert("filtertable/filtercss"); ?>
<?php $this->end(); ?>

<?php $this->start("scripts"); ?>
<?php $this->insert("filtertable/filtertable"); ?>
<?php $this->end(); ?>