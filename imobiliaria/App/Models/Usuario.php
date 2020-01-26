<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model {
	private $id;
	private $imagem_perfil;
	private $nome;
	private $email;
	private $senha;
	private $telefone;
	private $status;
	private $comprador;
	private $vendedor;
	private $administrador;
	private $corretor;
	
	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}

	//salvar
	public function salvar(){
		$query = "insert into tb_usuarios(nome, telefone, email, senha) values(:nome, :telefone, :email, :senha)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':telefone', $this->__get('telefone'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha')); //metodo md5 para crisptografia
		if(!$stmt->execute()){
			print_r($stmt->errorInfo());
		}else{
			echo "salvou usuario";
		}

		if(isset($this->imagem_perfil)){
			$id = $this->getIdPorEmail();
			$this->id = $id['id'];
			$nomeImagem = time().$this->imagem_perfil['name'];
			$diretorio = "img/usuarios/".$this->id."/";
			mkdir($diretorio, 0755);
			$query = "update tb_usuarios set imagem_perfil = :imagem where id = :id";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':imagem', $diretorio.$nomeImagem);
			$stmt->bindValue(':id', $this->id);

			if(!$stmt->execute()){
				print_r($stmt->errorInfo());
			}else{
				move_uploaded_file($this->imagem_perfil['tmp_name'], $diretorio.$nomeImagem);
				echo "salvou imaegem";
			}
		}

		//return $this;
	}

	public function validarCadastro(){
		$valido = true;

		if(strlen($this->__get('nome')) < 3){
			$valido = false;
		}
		if(strlen($this->__get('telefone')) < 8){
			$valido = false;
		}
		if(strlen($this->__get('email')) < 3){
			$valido = false;
		}
		if(strlen($this->__get('senha')) < 3){
			$valido = false;
		}

		return $valido;
	}

	public function getUsuarioPorEmail(){
		$query = "select nome, email from tb_usuarios where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getIdPorEmail(){
		$query = "select id from tb_usuarios where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->email);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function getCorretores(){
		$query = "select id, nome, email from tb_usuarios where corretor = 1";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function autenticar(){
		$query = "select 
					id, 
					nome, 
					email, 
					comprador, 
					vendedor, 
					administrador, 
					corretor 
				from 
					tb_usuarios 
				where 
					email = :email and senha =:senha";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha'));
		$stmt->execute();


		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
		
		if($usuario['id'] != '' && $usuario['nome'] != ''){
			$this->__set('id', $usuario['id']);
			$this->__set('nome', $usuario['nome']);
			$this->__set('comprador', $usuario['comprador']);
			$this->__set('vendedor', $usuario['vendedor']);
			$this->__set('administrador', $usuario['administrador']);
			$this->__set('corretor', $usuario['corretor']);
		}

		return $this;
	}

	public function getAll(){
		$query = "
			select 
				*
			from 
				tb_usuarios
			";
		$stmt = $this->db->prepare($query);
		
		if(!$stmt->execute()){
			echo "<br><br><br><br><br>";
			print_r($stmt->errorInfo());
		}

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function removerCorretor(){
		$query = "select count(*) from tb_imoveis where corretor_responsavel = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->id);

		if(!$stmt->execute()){
			print_r($stmt->errorInfo());
		}else{
			$qtdImovel = $stmt->fetch(\PDO::FETCH_ASSOC);
		}

		//echo $qtdImovel['count(*)']; 
		if($qtdImovel['count(*)'] == 0){
			$query = "update tb_usuarios set corretor = 0 where id = :id_usuario";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':id_usuario', $this->id);

			if(!$stmt->execute()){
				echo "<br><br><br><br><br>";
				print_r($stmt->errorInfo());
			}
				return $qtdImovel['count(*)'];
		}else{
			return $qtdImovel['count(*)'];
		}
	}

	public function adicionarCorretor(){
		$query = "update tb_usuarios set corretor = 1 where id = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->id);

		if(!$stmt->execute()){
			echo "<br><br><br><br><br>";
			print_r($stmt->errorInfo());
		}

		return true;
	}
}

?>