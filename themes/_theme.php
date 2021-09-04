<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- FAVICON -->
   <link rel="shortcut icon" href="<?= asset("imgs/fav.png"); ?>" type="image/x-icon">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="<?= asset("css/bootstrap.min.css"); ?>">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

   <!-- MEU ESTILO -->
   <link rel="stylesheet" href="<?= asset("main/estilo.css"); ?>">

   <!-- ESTILO CASO QUEIRA PREENCHER -->
   <?= $this->section('styles'); ?>

   <!-- TITULO -->
   <title><?= $title; ?></title>
</head>

<body style="background-color: #f3f3f3">
   <main style="margin-top: 70px;">
      <div class="container bg-white p-4 rounded">
         <div class="row">
            <div class="col-md-12 text-center mb-4">
               <img src="<?= asset('imgs/logo.png'); ?>" class="img-fluid">
            </div>
            <div class="col-md-12">
               <?= $this->insert('login/mensagem'); ?>
            </div>
            <?= $this->section('content'); ?>
         </div>
      </div>
   </main>

   <!-- BOOTSTRAP SCRIPTS -->
   <script src="<?= asset('js/jquery-3.6.0.min.js'); ?>"></script>
   <script src="<?= asset('js/bootstrap.bundle.min.js'); ?>"></script>

   <!-- OUTROS SCRIPTS -->
   <?= $this->section('scripts'); ?>
</body>

</html>