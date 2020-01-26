<?php

namespace App\Models;

use MF\Model\Model;

class Imagem extends Model {

	private $id;
	private $imagem;


	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}

	public function salvar(){
		//echo $this->imagem['name'];
		$nomeImagem = time().$this->imagem['name'];
		$ultimoId = $this->db->lastInsertId();
		$diretorio = "img/usuarios/".$ultimoId."/";
		mkdir($diretorio, 0755);
		$query = "insert into tb_imagens (imagem) values (:imagem)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':imagem', $diretorio.$nomeImagem);
		
		if($stmt->execute()){
			move_uploaded_file($this->imagem['tmp_name'], $diretorio.$nomeImagem);
		}else{
			echo "Error";
		}

		return $this;
	}

	public function retornarImagem(){

		$query = "SELECT imagem from tb_imagens WHERE id = 23";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);

	}

}