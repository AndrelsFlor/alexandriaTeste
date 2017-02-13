<?php
require_once 'CRUD.php';
require_once 'obrasClasse.php';
 class Editora extends CRUD{

protected $tabela = 'editora';

private $nome;
private $cnpj;
private $email;
private $senha;
private $fotoPerfil;

public function insert(){

	$sql = "INSERT INTO $this->tabela(nome,cnpj,email,senha,fotoPerfil) VALUES(:nome,:cnpj,:email,:senha,:fotoPerfil)";

	$stmt = BD::prepare($sql);

	$stmt->bindParam(':nome', 			$this->nome);
	$stmt->bindParam(':cnpj', 			$this->cnpj);
	$stmt->bindParam(':email', 			$this->email);
	$stmt->bindParam(':senha', 			$this->senha);
	$stmt->bindParam(':fotoPerfil', $this->fotoPerfil);

	return $stmt->execute();
}

public function update($id){

	$sql = "UPDATE $this->tabela SET nome = :nome,  email = :email WHERE id = :id";

	$stmt = BD::prepare($sql);

	$stmt->bindParam(':nome', 			$this->nome);

	$stmt->bindParam(':email', 			$this->email);

	$stmt->bindParam(':id',				$id);

	return $stmt->execute();

}

public function updateImagem($id){
	$sql = "UPDATE $this->tabela SET logo = :logo WHERE ID = :id";
	$stmt = BD::prepare($sql);
	$stmt->bindParam(':logo',$this->fotoPerfil);
	$stmt->bindParam(':id',$id);
	return $stmt->execute();
}

public function login($email,$senha){

	$sql = "SELECT * FROM $this->tabela WHERE email = :email";
	$stmt = BD::prepare($sql);
	$stmt->bindParam(':email',$email);
	$stmt->execute();
	$consulta = $stmt->fetch();
	if(!empty($consulta)){
		$senha2 = $consulta->senha;
		if(password_verify($senha,$senha2)){
			return $consulta->ID;
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}
}

public function aprovaObra($idObra,$idEditora){
	$sql = "INSERT INTO obrasaprovadas(idObra,idEditora) VALUES(:idObra,:idEditora)";

	$stmt = BD::prepare($sql);

	$stmt->bindParam(':idObra',		$idObra);
	$stmt->bindParam(':idEditora',	$idEditora);

	return $stmt->execute();

}

public function buscaTodasObras(){
	$sql = "SELECT obras.id AS obrasID, obras.titulo AS obrasTitulo, obras.caminho AS obrasCaminho,obras.descricao AS obrasDescricao, obras.pgDisp as obrasPgDisp, obras.pgTotal as obrasPgTotal, escritor.nome AS nome FROM obras INNER JOIN obraescritor ON (obraescritor.idObra = obras.id) INNER JOIN escritor ON (obraescritor.idEscritor = escritor.ID) INNER JOIN tags ON(obras.idTag = tags.id)";
	$stmt = BD::prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll();
}


public function buscaObrasTag($tag){

$sql = "SELECT obras.id AS obrasID, obras.titulo AS obrasTitulo, obras.caminho AS obrasCaminho,obras.descricao AS obrasDescricao, obras.pgDisp as obrasPgDisp, obras.pgTotal as obrasPgTotal, escritor.nome AS nome FROM obras INNER JOIN obraescritor ON (obraescritor.idObra = obras.id) INNER JOIN escritor ON (obraescritor.idEscritor = escritor.ID) INNER JOIN tags ON(obras.idTag = tags.id) WHERE obras.idTag = :idTag";
$stmt = BD::prepare($sql);

$stmt->bindParam(':idTag',$tag);
$stmt->execute();

return $stmt->fetchAll();
}
public function setNome($nome){
	$this->nome = $nome;
}

public function setCNPJ($cnpj){
	$this->cnpj = $cnpj;
}

public function setEmail($email){
	$this->email = $email;
}

public function setSenha($senha){
	$this->senha = password_hash($senha,PASSWORD_DEFAULT);
}

public function setFotoPerfil($fotoPerfil){
	$this->fotoPerfil = $fotoPerfil;

}

}


?>
