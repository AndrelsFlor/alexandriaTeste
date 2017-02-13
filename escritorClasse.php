<?php
require_once 'CRUD.php';
 class Escritor extends CRUD{

protected $tabela = 'escritor';

private $nome;
private $cpf;
private $email;
private $senha;
private $fotoPerfil;

public function insert(){

	$sql = "INSERT INTO $this->tabela(nome,cpf,email,senha,fotoPerfil) VALUES(:nome,:cpf,:email,:senha,:fotoPerfil)";

	$stmt = BD::prepare($sql);

	$stmt->bindParam(':nome', 			$this->nome);
	$stmt->bindParam(':cpf', 			$this->cpf);
	$stmt->bindParam(':email', 			$this->email);
	$stmt->bindParam(':senha', 			$this->senha);
	$stmt->bindParam(':fotoPerfil', 	$this->fotoPerfil);

	return $stmt->execute();
}

public function update($id){

	$sql = "UPDATE $this->tabela SET nome = :nome, cpf = :cpf, email = :email, senha = :senha, fotoPerfil = :fotoPerfil WHERE id = :id";

	$stmt = BD::prepare($sql);

	$stmt->bindParam(':nome', 			$this->nome);
	$stmt->bindParam(':cpf', 			$this->cpf);
	$stmt->bindParam(':email', 			$this->email);
	$stmt->bindParam(':senha', 			$this->senha);
	$stmt->bindParam(':fotoPerfil', 	$this->fotoPerfil);
	$stmt->bindParam(':id',				$id);

	return $stmt->execute();

}

public function updateParcial($id){

	$sql = "UPDATE $this->tabela SET nome = :nome,  email = :email WHERE id = :id";

	$stmt = BD::prepare($sql);

	$stmt->bindParam(':nome', 			$this->nome);

	$stmt->bindParam(':email', 			$this->email);

	$stmt->bindParam(':id',				$id);

	return $stmt->execute();
}

public function updateImagem($id){

	$sql = "UPDATE $this->tabela SET fotoPerfil = :fotoPerfil WHERE id = :id";

	$stmt = BD::prepare($sql);
	$stmt->bindParam(':fotoPerfil', 	$this->fotoPerfil);
	$stmt->bindParam(':id',				$id);
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

public function verificaAprovacao($idEscritor){

  $sql = "SELECT obraescritor.idObra as id_obra_escritor,obras.titulo, obrasaprovadas.idEditora as id_obra_editora, editora.nome AS editora_nome FROM obraescritor INNER JOIN obrasaprovadas ON(obrasaprovadas.idObra = obraescritor.idObra) INNER JOIN obras ON(obraescritor.idObra = obras.id) INNER JOIN editora ON(obrasaprovadas.idEditora = editora.id) WHERE obraescritor.idEscritor = :idEscritor AND obrasaprovadas.visualizado <> 1";

  $stmt = BD::prepare($sql);

  $stmt->bindParam(':idEscritor',$idEscritor);

  $stmt->execute();

	return $stmt->fetchAll();
}

public function setNome($nome){
	$this->nome = $nome;
}

public function setCPF($cpf){
	$this->cpf = $cpf;
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
