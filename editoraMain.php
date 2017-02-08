<?php
	require_once 'editoraClasse.php';
	require_once 'obrasClasse.php';
	require_once 'tagsClasse.php';
	$postData = json_decode(file_get_contents("php://input"));

	if($postData->acao == 'carregaDadosEditora'){

		$id = $postData->id;


		$editora = new Editora();

		$consulta = $editora->busca($id);

		$resposta = array("nome"=>$consulta->nome,
						   "cnpj"=>$consulta->cnpj,
						   "email"=>$consulta->email,
						   "logo"=>$consulta->logo,
						   "biografia"=>$consulta->biografia);

		echo json_encode($resposta);
	}
	else if($postData->acao == "updateEditora"){

		$editora = new Editora();

		$id = $postData->id;
		$nome = $postData->nome;
		$email = $postData->email;

		$editora->setNome($nome);
		$editora->setEmail($email);
		$editora->update($id);

		$consulta = $editora->busca($id);

		$resposta = array("nome"=>$consulta->nome,
						  "email"=>$consulta->email);

		echo json_encode($resposta);

	}
	else if($postData->foto){
		echo $postData;

	}
	else if($postData->acao="carregaTags"){
		$tags = new Tags();

		$consulta = $tags->buscaTudo();

		$resposta = array("id"=>$consulta->id,
											"nome"=>$consulta->tag);

	echo json_encode($resposta);

	}
?>
