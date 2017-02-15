<?php


header('Content-type: text/plain; charset=utf-8');


	require_once 'escritorClasse.php';
	require_once 'editoraClasse.php';
	require_once 'obrasClasse.php';
	require_once 'tagsClasse.php';

	$acao = $_POST['acao'];

	if($acao == 'login'){
		echo 'sucesso!';
		session_start();
		$escritor = new Escritor();
		$editora = new Editora();

		$email = $_POST['email'];
		$senha = $_POST['senha'];



		$hash = password_hash($senha,PASSWORD_DEFAULT);

		if($escritor->login($email,$senha)){
			$id =  $escritor->login($email,$senha);
			$_SESSION['id'] = $id;
			header('location:escritor.php?id='.$id);
		}
		else if($editora->login($email,$senha)){
			$id =  $editora->login($email,$senha);

			header('location:editora.php?id='.$id);

		}
		else{

			echo "login inválido";
		}
	}
	else if($acao == 'listaObras'){
		$idEscritor = $_POST['idEscritor'];
		$obras = new Obras();
?>
	<div class="col-md-9 col-md-offset-2">
	<table id="tabelaObras" class="table table-striped table-condensed table-bordered">
	<thead>
	<tr>
		<th>Titulo</th>
		<th>Gênero</th>
	</tr>
	</thead>


<?php
		foreach($obras->selectObrasEscritor($idEscritor) as $valor){

?>
		<tbody>
		<tr>
			<td><a href="uploads/<?php echo $valor->caminho;?>"><?php echo $valor->titulo;?></a></td>
			<td><?php echo $valor->tag;?></td>
			<td><button type="button"  class="btnDeletaObra btn btn-danger glyphicon glyphicon-trash" id="<?php echo $valor->idObra;?>" idEscritor="<?php echo $idEscritor;?>"></button></td>

		</tr>
		</tbody>

<?php

		}
?>
  </table><br>
  <button type="button" id="btnCancelaLista" class="btn btn-danger btn-lg btn-block login-button">Cancelar</button>
  </div>
<?php
	}
	else if($acao == 'updateEscritorLayout'){
		$escritor = new Escritor();
		$id = $_POST['id'];
		$valor = $escritor->busca($id);
?>

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
									<input type="text" class="form-control" name="nome" id="name"  placeholder="Insira um nome" value="<?php echo $valor->nome;?>"/>
								</div>
							</div>
						</div>
						<input type="hidden" value="<?php echo $id?>" name="id">
						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">E-mail</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Insira um endereço de email válido" value="<?php echo $valor->email;?>"/>
								</div>
							</div>
						</div>




						<div class="form-group ">
							<button id="confirmarUpdate"type="button" class="btn btn-primary btn-lg btn-block login-button">Confirmar</button>
							<button id="cancelarUpdate"type="button" class="btn btn-danger btn-lg btn-block login-button">Cancelar</button>
						</div>
						<<input type="hidden" name="acao" value="updateEscritor">
					</form>

				</div>
			</div>
		</div>

<?php
	}
	else if($acao == 'cancelar'){
		echo "";
	}
	else if($acao == 'updateEscritor'){
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$id = $_POST['id'];

		$escritor = new Escritor();

		$escritor->setNome($nome);
		$escritor->setEmail($email);

		$escritor->updateParcial($id);

		echo $nome;
	}

	else if($acao == 'updateImagemLayout'){
		$id = $_POST['id'];
?>
	<form id="uploaImagemForm" enctype="multipart/form-data">
	<input type="file" name="foto"><br>
	<input type="hidden" name="acao" value="uploadImagem">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="submit" class="btn btn-success btn-md" value="Enviar" id="btnEnviaImagem">
	<button type="button" id="btnCancelaImagem" class="btn btn-danger btn-md">Cancelar</button>
	</form>

<?php
	}
	else if($acao == 'uploadImagem'){
			$id = $_POST['id'];

			date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

		     $ext = strtolower(substr($_FILES['foto']['name'],-4)); //Pegando extensão do arquivo
		     $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
		     $dir = 'imagens/'; //Diretório para uploads

		     move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name); //Fazer upload do arquiv

		    $escritor = new Escritor();
		    $escritor->setFotoPerfil($new_name);
		    $escritor->updateImagem($id);
?>

	        <img src="imagens/<?php echo $new_name;?>" class="img-responsive thumbnail">

<?php
	}
	else if($acao == 'uploadObraLayout'){
		$idEscritor = $_POST['id'];
		$tags = new Tags();
?>

	<div class="panel-body">
						<h4>Formulário para upload de obra</h4>
			    		<form role="form" id="formUploaObra" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="titulo" id="titulo" class="form-control input-sm" placeholder="Título">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="file" name="obra" id="obra">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<select  name="tag" id="tag" class="form-control input-sm" >
			    					<?php
			    						foreach($tags->buscaTudo() as $valor){
			    					?>

			    					<option value="<?php echo $valor->id;?>"><?php echo $valor->tag;?></option>
			    					<?php

			    						}
			    					?>
			    				</select>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="pgDisp" id="password" class="form-control input-sm" placeholder="Número de páginas disponíveis">&nbsp;
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">

			    						<input type="text" name="pgTotal" id="password_confirmation" class="form-control input-sm" placeholder="Número total de páginas">
			    					</div>
			    				</div>
			    			</div>
			    			<input type="hidden" value="<?php echo $idEscritor;?>" name="idEscritor">
			    			<input type="hidden" value="uploadObra" name="acao">
			    			<input type="submit" id="confirmaUploadObra" class="btn btn-primary btn-lg btn-block login-button" value="Enviar" >
							<button id="cancelaUploadObra" type="button" class="btn btn-danger btn-lg btn-block login-button">Cancelar</button
			    			</form>
<?php
	}
	else if($acao == 'uploadObra'){

			$obra = new Obras();
			date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

		     $ext = strtolower(substr($_FILES['obra']['name'],-4)); //Pegando extensão do arquivo
		     $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
		     $dir = 'uploads/'; //Diretório para uploads

		     move_uploaded_file($_FILES['obra']['tmp_name'], $dir.$new_name); //Fazer upload do arquiv

		     $idEscritor = $_POST['idEscritor'];
		     $titulo = $_POST['titulo'];
		     $idTag = $_POST['tag'];
		     $caminho = $new_name;
		     $pgDisp = $_POST['pgDisp'];
		     $pgTotal = $_POST['pgTotal'];

		     $obra->setIdEscritor($idEscritor);
		     $obra->setTitulo($titulo);
		     $obra->setIdTag($idTag);
		     $obra->setCaminho($caminho);
		     $obra->setPgDisp($pgDisp);
		     $obra->setDescricao('0');
		     $obra->setPgTotal($pgTotal);

		     $obra->insert();
	}

	else if($acao == 'updateImagemEditora'){
		$id = $_POST['id'];

				date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

			     $ext = strtolower(substr($_FILES['foto']['name'],-4)); //Pegando extensão do arquivo
			     $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
			     $dir = 'imagens/'; //Diretório para uploads

			     move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name); //Fazer upload do arquiv

			    $editora = new Editora();
			    $editora->setFotoPerfil($new_name);
			    $editora->updateImagem($id);
	?>

		        <img src="imagens/<?php echo $new_name;?>" class="img-responsive thumbnail">

	<?php
		}
		else if($acao == 'pesquisaObrasLayout'){
			$editora = new Editora();

			foreach ($editora->buscaTodasObras() as $valor){
	?>
			teste

	<?php
			}

		}

		else if($acao == 'deletaObra'){

				$id = $_POST['idObra'];
				$idEscritor = $_POST['idEscritor'];
				$obra = new Obras();
				$obra->delete($id);

 ?>
 <div class="col-md-9 col-md-offset-2">
	<table id="tabelaObras" class="table table-striped table-condensed table-bordered">
 <?php
				foreach($obra->selectObrasEscritor($idEscritor) as $valor){

		?>
				<tbody>
				<tr>
					<td><a href="uploads/<?php echo $valor->caminho;?>"><?php echo $valor->titulo;?></a></td>
					<td><?php echo $valor->tag;?></td>
					<td><button type="button"  class="btnDeletaObra glyphicon glyphicon-trash" id="<?php echo $valor->idObra;?>"></button></td>

				</tr>
				</tbody>
</table>

<button type="button" id="btnCancelaLista" class="btn btn-danger btn-lg btn-block login-button">Cancelar</button>
</div>
		<?php

				}

		}
		else if($acao == "carregaDadosEditora"){

			$id = $_POST['id'];

			$editora = new Editora();

			$consulta = $editora->busca($id);

			$resposta = array('id' 				=> $consulta->ID,
												'nome' 			=> $consulta->nome,
												'cnpj'			=> $consulta->cnpj,
												'email'			=> $consulta->email,
												'biografia' => $consulta->biografia,
												'logo'			=> $consulta->logo
												);

		echo json_encode($resposta);

		}

		else if($acao == "updateEditora"){
			$editora = 		new Editora();
			$email	=			$_POST['email'];
			$nome 	=			$_POST['nome'];
			$id 		= 		$_POST['id'];

			$editora->setNome($nome);
			$editora->setEmail($email);

			$editora->update($id);

			$consulta = $editora->busca($id);

			$resposta = array('nome'	=> $consulta->nome,
												'email' => $consulta->email);

			echo json_encode($resposta);


		}

		else if($acao == "loadTags"){
			$tags = new Tags();

			$generos = [];

			foreach($tags->buscaTudo() as $valor){
					$tags = array('id' 	=> $valor->id,
												'tag' => $valor->tag);

				array_push($generos,$tags);
			}

			echo json_encode($generos);
		}

		else if($acao == 'loadObrasEditora'){
			$tag =  $_POST['tag'];

			if($tag == 'todas'){
				$obras = [];

				$editora = new Editora();

				foreach($editora->buscaTodasObras() as $valor){
					$obra = array('id' => $valor->obrasID,
												'titulo' 		=> $valor->obrasTitulo,
												'caminho' 	=> $valor->obrasCaminho,
												'descricao' => $valor->obrasDescricao,
												'pgDisp' 		=> $valor->obrasPgDisp,
												'pgTotal' 	=> $valor->obrasPgTotal,
												'autor'			=> $valor->nome);

					array_push($obras,$obra);
				}

				echo json_encode($obras);
			}
			else{
				$obras = [];

				$editora = new Editora();

				foreach($editora->buscaObrasTag($tag) as $valor){
					$obra = array('id' => $valor->obrasID,
												'titulo' 		=> $valor->obrasTitulo,
												'caminho' 	=> $valor->obrasCaminho,
												'descricao' => $valor->obrasDescricao,
												'pgDisp' 		=> $valor->obrasPgDisp,
												'pgTotal' 	=> $valor->obrasPgTotal,
												'autor'			=> $valor->nome);

					array_push($obras,$obra);
			}

			echo json_encode($obras);


		}
	}

	else if($acao =="loadObraView"){
		$obra = new Obras();
		$id = $_POST['idObra'];
		$busca = $obra->busca($id);

		$resposta = array(
			'id' => $busca->id,
			'caminho' => $busca->caminho,
		);

		echo json_encode($resposta);
	}

	else if($acao == "aprovaObra" ){
		$idEditora = $_POST['idEditora'];
		$idObra = $_POST['idObra'];
		$texto = $_POST['texto'];

		$editora = new Editora();

		$editora->aprovaObra($idObra,$idEditora,$texto);
	}

	else if($acao == "verificaAprovacao"){
		$idEscritor = $_POST['id'];
		$cont = 0;
		$escritor = new Escritor();
		$obj = [];
		if($escritor->verificaAprovacao($idEscritor) != "" ){

			foreach($escritor->verificaAprovacao($idEscritor) as $valor){
				$cont++;
			$resposta = array(
												"idEditora" => $valor->id_obra_editora,
												"nome_editora" => $valor->editora_nome,
												"idObra" => $valor->id_obra_escritor,
												"titulo" => $valor->titulo,
												"flag" => 0,
												"cont" => $cont

			);
			array_push($obj,$resposta);
		}
			echo json_encode($obj);
		}
	}

	else if($acao == "visualizaAprovacao"){
		$escritor = new Escritor();
		$idEscritor = $_POST['id'];
		$escritor->visualizaAprovacao($idEscritor);

		$resposta = [];

		foreach($escritor->visualizaAprovacao($idEscritor) as $valor){
			$consulta = array(
											"nome_editora" => $valor->editora_nome ,
											"nome_obra" =>$valor->titulo,
											"texto"	=>$valor->texto
			);

			array_push($resposta,$consulta);
		}

		echo json_encode($resposta);
	}



?>
