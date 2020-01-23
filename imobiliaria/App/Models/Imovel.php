<?php

namespace App\Models;

use MF\Model\Model;

class Imovel extends Model {
	private $id;
	private $fk_id_proprietario;
	private $endereco;
	private $numero;
	private $bairro;
	private $cep;
	private $descricao_imovel;
	private $valor;
	private $qtd_cliques;
	private $cidade;
	private $area_util;
	private $area_total;
	private $quartos;
	private $banheiros;
	private $garagens;
	private $suites;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}

	//salvar
	public function salvar(){
		$query = "insert into 
				imovel(
					fk_id_proprietario,
					endereco,
					numero,
					bairro,
					cep,
					descricao_imovel,
					valor,
					cidade,
					area_util,
					area_total,
					quartos,
					banheiros,
					garagens,
					suites
					) 
				values(
					:fk_id_proprietario,
					:endereco,
					:numero,
					:bairro,
					:cep,
					:descricao_imovel,
					:valor,
					:cidade,
					:area_util,
					:area_total,
					:quartos,
					:banheiros,
					:garagens,
					:suites
				)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':fk_id_proprietario', $this->__get('fk_id_proprietario'));
		$stmt->bindValue(':endereco', $this->__get('endereco'));
		$stmt->bindValue(':numero', $this->__get('numero'));
		$stmt->bindValue(':bairro', $this->__get('bairro'));
		$stmt->bindValue(':cep', $this->__get('cep'));
		$stmt->bindValue(':descricao_imovel', $this->__get('descricao_imovel'));
		$stmt->bindValue(':valor', $this->__get('valor'));
		$stmt->bindValue(':cidade', $this->__get('cidade'));
		$stmt->bindValue(':area_util', $this->__get('area_util'));
		$stmt->bindValue(':area_total', $this->__get('area_total'));
		$stmt->bindValue(':quartos', $this->__get('quartos'));
		$stmt->bindValue(':garagens', $this->__get('garagens'));
		$stmt->bindValue(':suites', $this->__get('suites'));

		$stmt->execute();

		return $this;
	}

	public function getAll(){
		$query = "
			select 
				* 
			from 
				tb_imoveis
		";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

?>