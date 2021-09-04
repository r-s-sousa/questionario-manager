<!doctype html>
<html lang="pt-br">

<head>
   <meta charset="utf-8">

   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title><?= $title; ?></title>

   <link rel="icon" type="image/png" href=" <?= asset("imgs/main/dollar.png"); ?>">

   <!-- Bootstrap core CSS -->
   <link href="<?= asset('css/bootstrap.min.css'); ?>" rel="stylesheet">

   <!-- Estilo para login -->
   <link rel="stylesheet" href="<?= asset('login/login.css'); ?>">

</head>

<body class="text-center">

   <?= $this->section('content'); ?>

   <script src="<?= asset('js/jquery-3.6.0.min.js'); ?>"></script>
   <script src="<?= asset('js/bootstrap.bundle.min.js'); ?>"></script>
   
   <?= $this->section('scripts'); ?>

</body>

</html>