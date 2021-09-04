<?= $this->layout('login/_theme', ['title' => $title]); ?>

<form class="form-signin border p-4" action="<?= $router->route('login.post'); ?>" method="POST">
   <div class="row">
      <div class="col-md-12">
         <img class="mb-4 mt-2 img-fluid imgLogo" src="<?= asset('imgs/main/logo-yellow.png'); ?>" height="60">
      </div>
      <div class="col-md-12">
         <h1 class="h3 mb-3 font-weight-normal">Acesse sua conta</h1>
      </div>

      <div class="col-md-12 text-left">
         <label for="inputEmail">Seu email</label>
         <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
      </div>

      <div class="col-md-12 text-left">
         <label class="mt-3" for="inputPassword">Sua senha</label>
         <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
         <div class="checkbox my-2 text-center">
            <label>
               <input onchange="mudouPass()" type="checkbox" id="showpass" value="mostrar senha"> Mostrar senha
            </label>
         </div>
      </div>
      <div class="col-md-12">
         <?php $this->insert('login/mensagem'); ?>
      </div>
      <div class="col-md-12">
         <button class="btn btn-lg btn-primary my-3 w-50 buttonCustom" type="submit">Entrar</button>
      </div>
      <div class="col-md-12 d-flex justify-content-between mb-3 mt-1">
         <a class="text-dark font-italic" href="<?= $router->route('login.cadastro'); ?>">Não tem cadastro ?</a>
         <a class="text-dark font-italic" href="<?= $router->route('login.recuperar'); ?>">Esqueceu sua senha ?</a>
      </div>
   </div>
   </div>
</form>

<?php $this->start('scripts'); ?>
<script src="<?= asset('login/login.js'); ?>"></script>
<?php $this->end(); ?>