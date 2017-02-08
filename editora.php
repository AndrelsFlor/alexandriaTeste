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
	    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.js"></script>
	    <script src="//ajax.googleapis.com/ajax/libs/angularjs/X.Y.Z/angular-route.js"></script>
	    <script >
	    	angular.module("editora",[]);
	    	angular.module("editora").controller("editoraCtrl",function($scope,$http){


	    	$scope.$watch('id', function (id) {
	    		$scope.id = id;
	    		var dados = [];
	    		dados = {acao:"carregaDadosEditora",id};
	    	    $http.post("editoraMain.php",dados).then(function successCallback(data){
	    	    	 $scope.editora = data;
	    	    	 console.log($scope.editora.data.email);
	    	    	
	    	    	$scope.updateEmail = $scope.editora.data.email;	 
	    	    	$scope.updateNome = $scope.editora.data.nome;  
	    	    	
	    	    },function errorCallback(){
	    	    	alert("ocorreu um erro!");
	    	    });

   	 			$scope.updateEditora = function(updateNome,updateEmail){

   	 				var dados = {acao:"updateEditora",id:$scope.id,nome:updateNome,email:updateEmail};
   	 				$http.post("editoraMain.php",dados).then(function successCallback(data){
   	 					$scope.respostaUpdate = data;

   	 					if($scope.updateEmail === "" || $scope.updateNome === "" ){
   	 						$scope.erro = "Todos os  campos são obrigatórios!";
   	 						$scope.class="alert alert-warning";
   	 					}
   	 					else{
   	 						$scope.class="";
   	 						$scope.erro = "";
   	 						$scope.updateEmail = $scope.respostaUpdate.data.email;
   	 						$scope.updateNome = $scope.respostaUpdate.data.nome;
   	 						$scope.editora.data.nome = $scope.updateNome;
   	 					}
   	 				});
   	 			}

	    	    
	    	});

	    	

	    	
	    	$scope.cancela = function(){
	    	   if(confirm("deseja mesmo cancelar?")){
	    		$scope.updateEmail = $scope.editora.data.email;
	    		$scope.updateNome = $scope.editora.data.nome;
	    	}
	    	}
	    	
			 		

	    	});
	    </script>

	   
	<title>Página de editora</title>
	
</head>
<body ng-controller="editoraCtrl" ng-init="id=<?php echo $id;?>">

<div ng-init="carregaDados(dados)"></div>
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
                                            <h3>Bem-vindo(a),<div id="divNome">{{editora.data.nome}}</div></h3>
                                            
                                            <button id = "updateEditoraButton" type="button" class="btn btn-labeled btn-info" data-toggle="collapse" data-target="#updateEditora" aria-expanded="false" aria-controls="updateEditora">
                                                <span class="btn-label"><i class="fa fa-pencil"></i></span>Update</button>&nbsp;
                                                <a href="index.html"><button type="button" class="btn btn-danger">Sair</button></a>
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <div class="col-md-6 no-pad">
                                    <span title="Clique para mudar a foto de perfil">
                                        <div class="user-image" id="divImagem">
                                            <a  role="button" data-toggle="collapse" href="#escondida" aria-expanded="false" aria-controls="escondida"><img src="imagens/{{editora.data.logo}}" class="img-responsive thumbnail"></a>
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
                                										<input type="text" class="form-control" name="nome" id="name"  placeholder="Insira um nome" ng-model="updateNome"/>
                                									</div>
                                								</div>
                                							</div>
                                							
                                							<div class="form-group">
                                								<label for="email" class="cols-sm-2 control-label">E-mail </label>
                                								<div class="cols-sm-10">
                                									<div class="input-group">
                                										<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                										<input type="text" class="form-control" name="email" id="email"  placeholder="Insira o novo endereço de e-mail" ng-model="updateEmail" />

                                									</div>
                                								</div>

                                							</div>

                                							
                                							<div class={{class}}>{{erro}}</div>
                                							
                                							<div class="form-group ">
                                								<button id="confirmarUpdate"type="button" class="btn btn-primary btn-lg btn-block login-button" ng-click="updateEditora(updateNome,updateEmail)">Confirmar</button>
                                								<button id="cancelarUpdate"type="button" class="btn btn-danger btn-lg btn-block login-button" ata-toggle="collapse" data-target="#updateEditora" aria-expanded="false" aria-controls="updateEditora" ng-click="cancela()">Cancelar</button>
                                							</div>
                                							<<input type="hidden" name="acao" value="updateEscritor">
                                						</form>

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
                                    <a href="#" id="pesquisaObras" class="btn btn-default">
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
  

	 <script src="http://code.jquery.com/jquery-1.12.3.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
     <script src="editoraMain.js"></script>
</body>
</html>