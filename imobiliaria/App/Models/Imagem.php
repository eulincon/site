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
		$fp = fopen($this->imagem['tmp_name'], "rb");
		//header("Content-type: image/gif");
		$conteudo = fread($fp, $this->imagem['size']);
		$conteudo = addslashes($conteudo);
		fclose($fp);
		
		$query = "insert into tb_imagens (imagen) values (:imagem)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':imagem', $conteudo);
		$stmt->execute();
		return $this;
	}

	public function retornarImagem(){

		$query = "SELECT imagen from tb_imagens WHERE id = 3";
		$stmt = $this->db->prepare($query);
		$stmt->exercute();

		print_r($stmt);

		//return $stmt->fetch(\PDO::FETCH_ASSOC);

	}

}