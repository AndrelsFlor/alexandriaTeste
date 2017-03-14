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
<div class="container">
  <div class="panel panel-info">
    <div class="panel-heading">Aprovações</div>
    <div class="panel-body">
    <table class="table table-striped" id="tabelaAprov">
      <tr>
        <th>Crítico</th>
        <th>Obra</th>
        <th>Páginas disponíveis</th>
        <th>Páginas totais</th>

      </tr>
    </table>
    </div>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.12.3.js"></script>
<script src="admEditora.js"></script>
<script>
var tabela = document.getElementById("tabelaAprov");
var xhr = new XMLHttpRequest();
var idEditoraRaw = document.getElementById("idEditora");
xhr.open("POST","main.php");
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.onreadystatechange = function(){
  if(this.readyState == 4 && this.status == 200){
    var resposta = JSON.parse(this.responseText);
    var aprov = document.createElement("tbody");

    for(k in resposta){
      aprov.innerHTML = "<tr><td>"+resposta[k].critico+"</td>"+ "<td><a href=uploads/"+encodeURI(resposta[k].caminho)+">"+resposta[k].titulo+"</a></td>"+ "<td>"+resposta[k].pgDisp+"</td>"+"<td>"+resposta[k].pgTotal+"</td>" +"</tr>";
      tabelaAprov.appendChild(aprov);
    }
  }
}
xhr.send(encodeURI("idEditora="+idEditoraRaw.value)+"&acao=listaAprovacoes");
</script>
</body>
</html>
