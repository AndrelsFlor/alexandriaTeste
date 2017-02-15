<html>
<head>
  <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
  <?php
    $obra = $_GET['obra'];
    $editora = $_GET['usr'];
  ?>

  <div class="col-md-6" >
    <div class="row">
    <button class="btn btn-success" id="aprovaObra" style="margin-left:20">Aprovar</button>
    <button class="btn btn-danger" id="cancelaObra">Cancelar</button>

    <br><br>
    <div id="LayoutTexto">
        <h4 style="margin-left:20">Texto de aprovação</h4>
    <textarea id="textoAprovacao" rows="10" cols="50" style="margin-left:20" placeholder="Escreva aqui o texto que irá ser enviado ao escritor junto a notificação de sua aprovação. Coloque suas informações de contato e tudo mais que achar necessário informar ao escritor"></textarea>
    <br>
    <button class="btn btn-success" style="margin-left:20" id="btnConfirma">Enviar</button>
    <button class="btn btn-danger" >Cancelar</button>

  </div>
  </div>

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
