<?php
	require_once 'CRUD.php';

	 class Obras extends CRUD{

		protected $tabela = 'obras';

		private $titulo;
		private $caminho;
		private $idTag;
		private $descricao;
		private $pgDisp;
		private $pgTotal;
		private $idEscritor;


		public function insert(){
			$titulo = $this->titulo;
			$sql = "INSERT INTO $this->tabela(titulo,caminho,idTag,descricao,pgDisp,pgTotal) VALUES(:titulo,:caminho,:idTag,:descricao,:pgDisp,:pgTotal)";

			$stmt = BD::prepare($sql);
			
			$stmt->bindParam(':titulo', 	$this->titulo);
			$stmt->bindParam(':caminho', 	$this->caminho);
			$stmt->bindParam(':idTag', 		$this->idTag);
			$stmt->bindParam(':descricao', 	$this->descricao);
			$stmt->bindParam(':pgDisp', 	$this->pgDisp);
			$stmt->bindParam(':pgTotal', 	$this->pgTotal);
			
			$stmt->execute();

			$sql2 = "SELECT * FROM $this->tabela WHERE titulo = :titulo";
			$stmt2 = BD::prepare($sql2);
			$stmt2->bindParam(':titulo', $titulo);
			$stmt2->execute();

			$result = $stmt2->fetch();

			$idObra = $result->id;
			$idEscritor = $this->idEscritor;
			$sql3 = "INSERT INTO obraescritor(idObra,idEscritor) VALUES(:idObra,:idEscritor)";
			$stmt3 = BD::prepare($sql3);
			$stmt3->bindParam(':idObra', 		$idObra);
			$stmt3->bindParam(':idEscritor',	$idEscritor);

			return $stmt3->execute();

		}

		public function update($id){
			$sql = "UPDATE $this->tabela SET titulo = :titulo,caminho = :caminho,idTag = :idTag,descricao = :descricao,pgDisp = :pgDisp,pgTota = :pgTotall WHERE id = :id";

			$stmt->bindParam(':titulo', 	$this->titulo);
			$stmt->bindParam(':caminho', 	$this->caminho);
			$stmt->bindParam(':idTag', 		$this->idTag);
			$stmt->bindParam(':descricao', 	$this->descricao);
			$stmt->bindParam(':pgDisp', 	$this->pgDisp);
			$stmt->bindParam(':pgTotal', 	$this->pgTotal);
			$stmt->bindParam(':id',			$id);

			return $stmt->execute();
		}

		public function selectObrasEscritor($idEscritor){
			$sql = "SELECT * FROM $this->tabela INNER JOIN obraescritor ON ($this->tabela.ID = obraescritor.idObra AND obraescritor.idEscritor = :idEscritor) INNER JOIN tags ON tags.id = $this->tabela.idTag";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':idEscritor',$idEscritor);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}

		public function setCaminho($caminho){
			$this->caminho = $caminho;
		}

		public function setIdTag($idTag){
			$this->idTag = $idTag;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		public function setPgDisp($pgDisp){
			$this->pgDisp = $pgDisp;
		}

		public function setPgTotal($pgTotal){
			$this->pgTotal = $pgTotal;
		}
		public function setIdEscritor($idEscritor){
			$this->idEscritor = $idEscritor;
		}


	}
?>