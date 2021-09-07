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
            <th>Telefone</th>
            <th>Entrevista</th>
            <th>Gabarito</th>
            <th>Deletar</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($obPesquisadores as $pesquisador) : ?>
            <tr>
               <td><?= $pesquisador->id; ?></td>
               <td><?= $pesquisador->nome; ?></td>
               <td><?= $pesquisador->telefone; ?></td>
               <td><?= $pesquisador->termoUsoImagem ? "sim" : "não"; ?></td>
               <td><a href="<?= $router->route('app.verPesquisador', ['id' => $pesquisador->id]); ?>"> <i class="fas fa-database"></i></a></td>
               <td>
                  <!-- Botão para acionar modal -->
                  <a type="button" data-toggle="modal" data-target="#modalDeletar"><i class="fas fa-trash text-danger"></i></a>

                  <!-- Modal -->
                  <div class="modal fade" id="modalDeletar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Deletar questionário!</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              Tem certeza que deseja deletar esse questionário ?
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                              <a class="btn btn-danger" href="<?= $router->route('app.deletar', ['id' => $pesquisador->id]); ?>"></i>Deletar</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>

<div class="col-md-12">
   <a href="<?= $router->route('app.exportar'); ?>" class="btn btn-outline-info">Baixar</a>
</div>

<!-- filter table jquery -->
<?php $this->start("styles"); ?>
<?php $this->insert("filtertable/filtercss"); ?>
<?php $this->end(); ?>
<?php $this->start("scripts"); ?>
<?php $this->insert("filtertable/filtertable"); ?>
<?php $this->end(); ?>