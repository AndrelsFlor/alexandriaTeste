<html>
<head>
  <?php
    $id = $_GET['id'];
    session_start();
    if(!isset($_SESSION['id']) || $_SESSION['id'] != $id){
      session_destroy();
      header("location:editora.php?id=".$id);
    }
  ?>
  <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="container">
  <div class="panel panel-info">
    <div class="panel-heading">Críticos cadastrados no sistema</div>
    <div class="panel-body">
      <ul class="list-group">
        <li class="list-group-item">
          <form action="main.php" method="POST" id="cadastraCritico">
          <input type="text" required="true" name="nomeCritico" placeholder="Insira o nome do crítico que deseja cadastrar" size="40">
          <input type="hidden" name="acao" value="insereCritico">
          <input type="hidden" name="idEditora" id="idEditora" value="<?php echo $id;?>">
          <input type="submit" value="Cadastrar">
        </form>

        </li>
        <div  id="listaCriticos">
        </div>

      </ul>
    </div>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.12.3.js"></script>
<script src="admEditora.js"></script>
</body>
</html>
