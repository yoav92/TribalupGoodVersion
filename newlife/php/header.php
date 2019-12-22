<?php

  if(session_status() == PHP_SESSION_NONE){

    session_start();
  }

    ?>
  

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>S'inscrire sur Helpwork</title>
    <link rel="stylesheet"  href="./css/design.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" ></script>
	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" language="Javascript" src="./js/jquery-3.2.1.js"></script>
	<script type="text/javascript" language="Javascript" src="./js/func.js"></script>
  </head>
  <body>

  <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    HelpWork
  </a>
  <li class="nav-item active">
          <a class="nav-link disabled active" href="#"></a>
   </li>
   
</nav>


<div class="container">

    <?php if(isset($_SESSION['flash'])): ?>

        <?php foreach($_SESSION['flash'] as $type => $message): ?>

          <div class="alert alert-<?= $type; ?>">
            
            <?= $message; ?>

          </div>
        
        <?php endforeach; ?>

        <?php unset($_SESSION['flash']); ?>

    <?php endif; ?>