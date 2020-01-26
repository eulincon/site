<?php

namespace App\Models;

use MF\Model\Model;

class Imovel extends Model {
	private $id;
	private $fk_id_proprietario;
	private $fk_id_tipo;
	private $fk_id_status;
	private $corretor_responsavel;
	private $mostrar_na_index;
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
		$query = "select id from tb_tipo_imovel where tipo = :fk_id_tipo";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':fk_id_tipo', $this->fk_id_tipo);

		if(!$stmt->execute()){
			echo "<pre>";
			print_r($stmt->errorInfo());
			echo "</pre>";
		}

		$fk_id_tipo = $stmt->fetch(\PDO::FETCH_ASSOC);
		$this->fk_id_tipo = $fk_id_tipo['id'];

		$query = "insert into 
				tb_imoveis(
					fk_id_proprietario,
					fk_id_tipo,
					fk_id_status,
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
					:fk_id_tipo,
					fk_id_status,
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
		$stmt->bindValue(':fk_id_tipo', $this->__get('fk_id_tipo'));
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
		$stmt->bindValue(':banheiros', $this->__get('banheiros'));
		$stmt->bindValue(':garagens', $this->__get('garagens'));
		$stmt->bindValue(':suites', $this->__get('suites'));


		if(!$stmt->execute()){
			echo "<pre>";
			print_r($stmt->errorInfo());
			echo "</pre>";
			return false;
		}
		

		return true;
	}

	public function getAll(){
		$query = "
			select 
				i.*,
				t.tipo
			from 
				tb_imoveis as i
				left join tb_tipo_imovel as t on(t.id = i.fk_id_tipo)

		";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

	public function getImovelPorId($id){
		$query = "
			select 
				i.*,
				t.tipo,
				s.status
			from 
				tb_imoveis as i
				left join tb_tipo_imovel as t on(t.id = i.fk_id_tipo)
				left join tb_status_imovel as s on(s.id = i.fk_id_status)
			where i.id = :id
		";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id);

		if(!$stmt->execute()){
			echo "<br><br><br><br>";
			print_r($stmt->errorInfo());
		}

		return $stmt->fetch(\PDO::FETCH_ASSOC);

	}

	public function getImoveisPendentes(){
		$query = "
			select 
				i.*,
				t.tipo
			from 
				tb_imoveis as i
				left join tb_tipo_imovel as t on(t.id = i.fk_id_tipo)
			where i.fk_id_status = 5

		";

		$stmt = $this->db->prepare($query);

		if(!$stmt->execute()){
			echo "<br><br><br><br>";
			print_r($stmt->errorInfo());
		}

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

	public function getImoveisMostrarNaIndex(){
		$query = "
			select 
				i.*,
				t.tipo
			from 
				tb_imoveis as i
				left join tb_tipo_imovel as t on(t.id = i.fk_id_tipo)
			where i.mostrar_na_index = 1

		";

		$stmt = $this->db->prepare($query);

		if(!$stmt->execute()){
			echo "<br><br><br><br><br>";
			print_r($stmt->errorInfo());
		}

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

	public function definirCorretorResponsavel(){
		$query = "update tb_imoveis 
				  set corretor_responsavel = :corretor_responsavel 
				  where id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':corretor_responsavel', $this->corretor_responsavel);
		$stmt->bindValue('id', $this->id);

		if(!$stmt->execute()){
			echo "<br><br><br><br><br>";
			print_r($stmt->errorInfo());
		}

		return $this;
	}

	public function setNullCorretorResponsavel(){
		$query = "update tb_imoveis set corretor_responsavel = NULL where id = :id_imovel";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_imovel', $this->id);

		if(!$stmt->execute()){
			echo "<br><br><br><br><br>";
			print_r($stmt->errorInfo());
			return true;
		}

	}

	public function validarImovel(){
		$query = "update tb_imoveis set fk_id_status = 3 where id = :id_imovel";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_imovel', $this->id);

		if(!$stmt->execute()){
			echo "<br><br><br><br><br>";
			print_r($stmt->errorInfo());
		}
	}

}

?>