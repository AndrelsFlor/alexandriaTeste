<html>
<head>
  <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
  <?php
    $obra = $_GET['obra'];
    $editora = $_GET['usr'];
  ?>

  <div class="col-md-6">
    <div class="row">
    <button class="btn btn-success" id="aprovaObra">Aprovar</button>
    <button class="btn btn-danger" id="cancelaObra">Cancelar</button>
  </div>
  teste
  </div>
  <div class="col-md-6">
    <iframe src="" id="mostraObra" height="100%" width="100%"></iframe>
  </div>


  <input type="hidden" id="idObra" value="<?php echo $obra;?>">
  <input type="hidden" id="idEditora" value="<?php echo $editora;?>">



  <script src="http://code.jquery.com/jquery-1.12.3.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
  <script type="text/javascript" src="view.js"></script>

</body>
</html>
