<!DOCTYPE html>
<html ng-app="editora">
<head>
<?php
	$id = $_GET['id'];
?>
	<meta charset="utf-8">
	<link href="snippet.css">
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





	<title>Página de editora</title>

</head>
<body ng-controller="editoraCtrl" ng-init="id=<?php echo $id;?>">

<div ng-init="carregaDados(dados)"></div>
<div class="container">
	<input type="hidden" id="idEditora" value="<?php echo $id;?>">
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
                                            <h3>Bem-vindo(a),<div id="divNome"></div></h3>

                                            <button id = "updateEditoraButton" type="button" class="btn btn-labeled btn-info" data-toggle="collapse" data-target="#updateEditora" aria-expanded="false" aria-controls="updateEditora">
                                                <span class="btn-label"><i class="fa fa-pencil"></i></span>Update</button>&nbsp;
                                                <a href="index.html"><button type="button" class="btn btn-danger">Sair</button></a>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="col-md-6 no-pad">
                                    <span title="Clique para mudar a foto de perfil">
                                        <div class="user-image" id="divImagem">
                                            <a  role="button" data-toggle="collapse" href="#escondida" aria-expanded="false" aria-controls="escondida"><img id="logoEditora" src="" class="img-responsive thumbnail"></a>
                                                <div class="collapse" id="escondida">
                                                <form id="uploaImagemForm" enctype="multipart/form-data" >
                                                <input type="file" name="foto" ng-model="fotoEditora"><br>
                                                <input type="hidden" name="acao" value="uploadImagem">
                                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                                <input type="hidden" name="acao" value="updateImagemEditora">
                                                <input type="submit" class="btn btn-success btn-md" value="Enviar" id="btnEnviaImagem" >
                                                <button type="button" id="btnCancelaImagem" class="btn btn-danger btn-md" ng-click="cancela()">Cancelar</button>
                                                </form>
                                            	 </div>

                                        </div>
                                    </span>
                                    <div id="uploadImagemDiv"></div>
                                    </div>
                                </div>
                                <div class="row overview">

                                </div>
                                <div id="display">
                                <div class="collapse" id="updateEditora">
                                	<div class="col-md-9 col-md-offset-2">
                                				<div class="row main">
                                					<div class="panel-heading">
                                		               <div class="panel-title text-center">
                                		               		<h1 class="title">Atualize suas informações</h1>
                                		               		<hr />
                                		               	</div>
                                		            </div>
                                					<div class="main-login main-center">
                                						<form class="form-horizontal" id="formUpdateEscritor" method="post" action="#">

                                							<div class="form-group">
                                								<label for="name" class="cols-sm-2 control-label">Nome</label>
                                								<div class="cols-sm-10">
                                									<div class="input-group">
                                										<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                										<input type="text" class="form-control" name="nome" id="name"  placeholder="Insira um nome"  />
                                									</div>
                                								</div>
                                							</div>

                                							<div class="form-group">
                                								<label for="email" class="cols-sm-2 control-label">E-mail </label>
                                								<div class="cols-sm-10">
                                									<div class="input-group">
                                										<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                										<input type="text" class="form-control" name="email" id="email"  placeholder="Insira o novo endereço de e-mail"  />

                                									</div>
                                								</div>

                                							</div>


                                							<div id="divErro" class=""></div>

                                							<div class="form-group ">
                                								<button id="confirmarUpdate"type="button" class="btn btn-primary btn-lg btn-block login-button">Confirmar</button>
                                								<button id="cancelarUpdate"type="button" class="btn btn-danger btn-lg btn-block login-button" data-toggle="collapse" data-target="#updateEditora" aria-expanded="false" aria-controls="updateEditora" >Cancelar</button>
                                							</div>
                                							<input type="hidden" name="acao" value="updateEscritor">
                                						</form>

                                					</div>
                                				</div>
                                			</div>
                                </div>

																<div class="collapse" id="procuraObra">
																	<div class="col-md-9 col-md-offset-2">
																		<div class="row main">
																			<div class="panel-heading">
																							 <div class="panel-title text-center">
																									<h1 class="title">Pesquisa de obras</h1>
																									<hr/>

																								</div>

																						</div>

																			<div class="panel-body">
																				<div class="row">
																				<select id="selectTags" class="form-control col-md-2 col-md-offset-1">
																					<option selected> Escolha a categoria que deseja Pesquisar</option>

																				</select>
																				<br><br><br><br>
																				<table id="tabelaObras" class="table table-striped table-condensed table-bordered col-md-12 col-md-offset-1" style="">
																				<thead>
																				<tr>
																					<th>Titulo</th>
																					<th>Autor</th>
																					<th>Páginas Disponíveis</th>
																					<th>Total de páginas</th>
																				</tr>
																				</thead>
																				<tbody id="corpoTabela">
																				</tbody>
																			</table>
																			</div>
																			</div>
																		</div>

																			</div>
																</div>
                                </div>
                            </div>



                            <div class="col-md-1 user-menu-btns">
                                <div class="btn-group-vertical square" id="responsive">
                                    <a href="#" id="notificacao"class="btn btn-block btn-default active">
                                      <i class="fa fa-bell-o fa-3x"></i>
                                    </a>
                                    <a href="#" class="btn btn-default">
                                      <i class="fa fa-envelope-o fa-3x"></i>
                                    </a>
                                    <button id="pesquisaObras" class="btn btn-default" data-toggle="collapse" data-target="#procuraObra" ng-click="carregaTags()">
                                      <i class="fa fa-search fa-3x"></i>
                                    </button>
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



	 <script src="http://code.jquery.com/jquery-1.12.3.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
     <script src="editoraMain.js"></script>
</body>
</html>
