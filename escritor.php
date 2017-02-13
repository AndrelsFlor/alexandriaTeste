<html ng-app="escritor">
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="escritor.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

    <!-- Website CSS style -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">

    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.js"></script>

</head>
<body>
		<?php
            session_start();
			require_once 'obrasClasse.php';
			require_once 'escritorClasse.php';
			$id = $_GET['id'];

            if(!isset($_SESSION['id']) || $_SESSION['id'] != $id){
                session_destroy();
                header("location:index.html");
            }

            $escritor = new Escritor();

            $consulta = $escritor->busca($id);

            $foto = $consulta->fotoPerfil;
            $nome = $consulta->nome;
		?>


            <div class="container">
                <div class="row vertical-offset-100">
                    <div class="col-md-9 col-md-offset-2">
                        <div class="panel panel-default ">

                            <div class="panel-body">
                                <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet" media="screen">
                                <div class="container">
                                    <div class="row user-menu-container square">
                                        <div class="col-md-7 user-details">
                                            <div class="row coralbg white">
                                                <div class="col-md-6 no-pad">
                                                    <div class="user-pad">
                                                        <h3>Bem-vindo(a),<div id="divNome"><?php echo $nome;?></div></h3>

                                                        <button id = "updateEscritor"type="button" class="btn btn-labeled btn-info" href="#">
                                                            <span class="btn-label"><i class="fa fa-pencil"></i></span>Update</button>&nbsp;
                                                            <a href="index.html"><button type="button" class="btn btn-danger">Sair</button></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 no-pad">
                                                <span title="Clique para mudar a foto de perfil">
                                                    <div class="user-image" id="divImagem">
                                                        <img src="imagens/<?php echo $foto;?>" class="img-responsive thumbnail">
                                                    </div>
                                                </span>
                                                <div id="uploadImagemDiv"></div>
                                                </div>
                                            </div>
                                            <div class="row overview">

                                            </div>
                                            <div id="display">
                                            </div>
                                        </div>
                                        <div class="col-md-1 user-menu-btns">
                                            <div class="btn-group-vertical square" id="responsive">
                                                <a href="#" id="notificacao"class="btn btn-block btn-default active" >
                                                  <i class="fa fa-bell-o fa-3x" style="" id="notificaSino"></i>
                                                </a>
                                                <a href="#" class="btn btn-default">
                                                  <i class="fa fa-envelope-o fa-3x"></i>
                                                </a>
                                                <a href="#" id="obras" class="btn btn-default">
                                                  <i class="fa fa-book fa-3x"></i>
                                                </a>
                                                <a href="#" class="btn btn-default" id="uploadObra">
                                                  <i class="fa fa-cloud-upload fa-3x"></i>
                                                </a>

                                            </div>
                                        </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        	<input type="hidden" id="idEscritor" value="<?php echo $id;?>" ng-model="escritor.id">
            </div>
         	<script src="http://code.jquery.com/jquery-1.12.3.js"></script>
         	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenLite.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
         	<script src="escritor.js"></script>
</body>
</html>
