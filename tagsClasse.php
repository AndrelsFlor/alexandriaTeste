<?php
	require_once 'CRUD.php';

	class Tags extends CRUD{
		protected $tabela='tags';

		public function insert(){
			return false;
		}

		public function update($id){
			return false;
		}
	}
?>