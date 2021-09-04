<nav class="navbar navbar-expand-sm bg-dark fixed-top">
   <div class="container">

      <a class="navbar-brand">
         <a href="<?= $router->route('app.respostas'); ?>" class="nav-link text-white">Repostas</a>
      </a>

      <button class="navbar-toggler" data-toggle="collapse" data-target="#nav-principal">
         <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="nav-principal">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a href="<?= $router->route('app.logout'); ?>" class="btn btn-outline-danger">Sair</a>
            </li>
         </ul>
      </div>

   </div>
</nav>