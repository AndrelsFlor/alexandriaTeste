<?php
	require_once 'BD.php';

	abstract class CRUD extends BD{

		protected $tabela;

		abstract public function insert();
		abstract public function update($id);

		public function busca($id){
			$sql = "SELECT * FROM $this->tabela WHERE id = :id";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
		}

		public function buscaTudo(){
			$sql = "SELECT * FROM $this->tabela";
			$stmt = BD::prepare($sql);
			$stmt->execute();

			return $stmt->fetchAll();
		}

		public function delete($id){
			$sql = "DELETE FROM $this->tabela WHERE id = :id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			
			return $stmt->execute();

		}

	}
?>