<?php
$this->layout('_theme', ['title' => $title]);
$this->insert('partials/navbar', ['userId' => $userId]);
?>

<div class="col-md-12 text-center">
   <h2>Listagem de pesquisadores</h2>
</div>

<div class="col-md-12">
   <table class="table table-bordered" id="tabela">
      <thead class="thead-dark">
         <tr>
            <th>#</th>
            <th>Pesquisador</th>
            <th>Entrevista</th>
            <th>Gabarito</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($obPesquisadores as $pesquisador) : ?>
            <tr>
               <td><?= $pesquisador->id; ?></td>
               <td><?= $pesquisador->nome; ?></td>
               <td><?= $pesquisador->termoUsoImagem ? "sim" : "não"; ?></td>
               <td><a href="<?= $router->route('app.verPesquisador', ['id' => $pesquisador->id]); ?>"> <i class="fas fa-database"></i></a></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>

<div class="col-md-12">
   <a href="<?= $router->route('app.exportar'); ?>" target="_blank" class="btn btn-outline-info">Baixar</a>
</div>

<!-- filter table jquery -->
<?php $this->start("styles"); ?>
<?php $this->insert("filtertable/filtercss"); ?>
<?php $this->end(); ?>

<?php $this->start("scripts"); ?>
<?php $this->insert("filtertable/filtertable"); ?>
<?php $this->end(); ?>