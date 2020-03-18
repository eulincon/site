<?php

namespace App\Models;

use MF\Model\Model;

class Relatorio extends Model {
	private $id;
	private $fk_id_usuario;
	private $fk_id_imovel;
	private $relatorio;
	private $data;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}

	public function salvar(){
		$query = "insert into tb_relatorio_corretor (fk_id_usuario, fk_id_imovel, relatorio) values (:id_usuario, :id_imovel, :relatorio)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->fk_id_usuario);
		$stmt->bindValue(':id_imovel', $this->fk_id_imovel);
		$stmt->bindValue(':relatorio', $this->relatorio);

		if(!$stmt->execute()){
			echo "<br><br><br><br>";
			print_r($stmt->errorInfo());
		}
		return true;
	}

	public function getRelatoriosPorImovel(){
		$query = "select 
					DATE_FORMAT(data, '%d/%m/%Y %H:%i') as data, 
					relatorio 
				from 
					tb_relatorio_corretor 
				where 
					fk_id_imovel = :id_imovel";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_imovel', $this->fk_id_imovel);

		if(!$stmt->execute()){
			echo "<br><br><br><br>";
			print_r($stmt->errorInfo());
		}
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}