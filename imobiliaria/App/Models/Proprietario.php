<?php

namespace App\Models;

use MF\Model\Model;

class Proprietario extends Model {
	private $id;
	private $fk_id_usuario;
	private $endereco;
	private $numero;
	private $bairro;
	private $cep;
	private $cpf;
	private $cnpj;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}

	public function salvar(){
		$query = "insert into tb_proprietarios(fk_id_usuario, endereco, numero, bairro, cep, cpf, cnpj) values(:fk_id_usuario, :endereco, :numero, :bairro, :cep, :cpf, :cnpj)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':fk_id_usuario', $this->fk_id_usuario);
		$stmt->bindValue(':endereco', $this->endereco);
		$stmt->bindValue(':numero', $this->numero);
		$stmt->bindValue(':bairro', $this->bairro);
		$stmt->bindValue(':cep', $this->cep);
		$stmt->bindValue(':cpf', $this->cpf);
		$stmt->bindValue(':cnpj', $this->cnpj);

		if(!$stmt->execute()){
			echo "<br><br><br><br><br><br>";
			print_r($stmt->errorInfo());
		}

		return true;
	}

}