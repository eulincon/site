<?php

namespace App\Models;

use MF\Model\Model;

class ImagensImovel extends Model {

	private $id;
	private $fk_id_imovel;
	private $imagem;
	private $data;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}

}