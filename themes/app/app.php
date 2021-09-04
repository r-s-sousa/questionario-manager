<?php
$this->layout('_theme', ['title' => $title]);
$this->insert('partials/navbar', ['userId' => $userId]);
?>

<div class="container bg-white p-4 rounded">
   <div class="row">
      <div class="col-md-12 text-center mb-4">
         <img src="<?= asset('imgs/logo.png'); ?>" class="img-fluid">
      </div>
      <div class="col-md-12">
         <h2>Listagem de questionários</h2>
      </div>
      <div class="col-md-12">
         <table class="table table-bordered">
            <thead class="thead-dark">
               <tr>
                  <th>#</th>
                  <th>Pesquisador</th>
                  <th>Gabarito</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Rafael</td>
                  <td><a href="#"> <i class="fas fa-user"></i></a></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>