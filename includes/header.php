<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="https://54x1.github.io/AniBuy/img/icons/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href=" ./assets/custom.css">

      <script src="./assets/custom.js"></script>
</head>
<body>
<nav class="navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
<a class="navbar-brand" href="index.php">MyAniDex</a>
    </div>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="nav navbar-nav">
        <?php if(isset($_SESSION['id'])){?>
        <li class="<?php echo $act1 ?>"><a href="index.php">View My List</a></li>
        <li class="<?php echo $act2 ?>"><a href="search.php">Search AniDEX</a></li>
        <!-- <li class="<?php //echo $act3 ?>"><a href="#">Edit My List</a></li> -->
        <li class="<?php echo $act4 ?>"><a href="add.php">Add to My List</a></li>
        <?php } ?>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION['id'])){?>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          <?php
        }
        else{
          ?>
          <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php
        }
        ?>

      </ul>
    </div>
  </div>
</nav>
