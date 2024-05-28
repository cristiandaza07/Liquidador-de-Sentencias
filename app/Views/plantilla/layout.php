<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo $titulo; ?></title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/recursos/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style2.css">

  </head>
  <body>
    <?php echo $this->include('plantilla/'.$header); ?>

    <main>
      <?php echo $this->renderSection("contenido"); ?>
    <?php echo $this->include('plantilla/footer'); ?>
    <script src="<?php echo base_url();?>assets/recursos/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url();?>assets/recursos/jquery-3.7.1.js"></script>
    <script src="<?php echo base_url();?>assets/recursos/jquery.inputmask.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/jquery.inputmask.min.js"></script>-->
    <!--<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>-->


  </body>
</html>