<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action{

	public function timeline(){

		$this->validaAutenticacao();

		$this->view->nome = $_SESSION['nome'];
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];
		$this->view->vendedor = $_SESSION['vendedor'];
		$this->view->corretor = $_SESSION['corretor'];

		$imovel = Container::getModel('Imovel');
		$imoveis = $imovel->getImoveisMostrarNaIndex();

		$this->view->imoveis = $imoveis;


		$this->render('timeline', 'layout_app');
	}

	public function imovel(){

		$this->validaAutenticacao();

		$tweet = Container::getModel('Imovel');
		
		$tweet->__set('id_usuario', $_SESSION['id']);

		$tweet->salvar();

		header('Location: /timeline');
	}

	public function imovel_avaliacao(){
		
		$tweet = Container::getModel('Imovel');
		
		$tweet->__set('id_usuario', $_SESSION['id']);

		$tweet->salvar();

		header('Location: /timeline');
	}

	public function validaAutenticacao(){

		session_start();

		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
			header('Location: /?login=erro');
		}
	}

	public function registrarImovel(){

		$this->validaAutenticacao();
		$usuario = Container::getModel('Usuario');
		$usuario->id = $_SESSION['id'];
		$idProprietario = $usuario->getIdProprietarioPorIdUsuario();

		$imovel = Container::getModel('Imovel');

		echo "<pre>";
		print_r($_POST);
		echo "</pre>";

		$imovel->fk_id_proprietario = $idProprietario['id'];
		$imovel->fk_id_tipo = $_POST['tipoImovel'];
		$imovel->endereco = $_POST['endereco'];
		$imovel->numero = $_POST['numero'];
		$imovel->bairro = $_POST['bairro'];
		$imovel->cep = $_POST['cep'];
		$imovel->descricao_imovel = $_POST['descricao'];
		$imovel->valor = $_POST['valor'];
		$imovel->cidade = $_POST['cidade'];
		$imovel->area_util = $_POST['areaUtil'];
		$imovel->area_total = $_POST['areaTotal'];
		$imovel->quartos = $_POST['quartos'];
		$imovel->banheiros = $_POST['banheiros'];
		$imovel->garagens = $_POST['garagens'];
		$imovel->suites = $_POST['suites'];
		$imovel->imagens = $_FILES['imagens'];

		//echo count($_FILES['imagens']['tmp_name']);
		echo "<pre>";
		print_r($_FILES['imagens']);
		echo "</pre>";

		if($imovel->salvar()){
			header('Location: /timeline');
		}else{
			$this->view->erroCadastro = true;
			$this->render('cadastrar_imovel');
		}


	}

	public function cadastrar_imovel(){
		$this->validaAutenticacao();

		$this->view->corretor = $_SESSION['corretor'];
		$this->view->nome = $_SESSION['nome'];
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];

		if($_SESSION['vendedor'] == 0){
			$this->view->erroCadastro = false;
			$this->render('cadastrar_proprietario','layout_app');
		}elseif($_SESSION['vendedor'] == 1){
			$this->view->erroCadastro = false;
			$this->render('cadastrar_imovel','layout_app');			
		}

	}

	public function cadastrar_proprietario(){
		$this->view->erroCadastro = false;
		$this->render('cadastrar_proprietario','layout_app');
	}

	public function registrarProprietario(){

		$this->validaAutenticacao();

		$proprietario = Container::getModel('Proprietario');
		$proprietario->fk_id_usuario = $_SESSION['id'];
		$proprietario->endereco = $_POST['endereco'];
		$proprietario->numero = $_POST['numero'];
		$proprietario->bairro = $_POST['bairro'];
		$proprietario->cep = $_POST['cep'];
		$proprietario->cpf = $_POST['cpf'];
		$proprietario->cnpj = $_POST['cnpj'];

		$proprietario->salvar();

		$usuario = Container::getModel('Usuario');
		$usuario->id = $_SESSION['id'];
		$usuario->adicionarVendedor();
		$_SESSION['vendedor'] = 1;

		header('Location: /cadastrar_imovel');
	}

	public function imovel_detalhes(){
		$this->validaAutenticacao();

		$this->view->nome = $_SESSION['nome'];
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];
		$this->view->vendedor = $_SESSION['vendedor'];
		$this->view->corretor = $_SESSION['corretor'];

		$imovel = Container::getModel('Imovel');
		$imagens = $imovel->getImagensImovelPorId($_GET['imovel']);
		$imovel = $imovel->getImovelPorId($_GET['imovel']);

		$this->view->imovel = $imovel;
		$this->view->imagens = $imagens;

		$this->render('imovel_detalhes','layout_app');
	}

	public function meus_imoveis(){

		$this->validaAutenticacao();

		$this->view->corretor = $_SESSION['corretor'];
		$this->view->nome = $_SESSION['nome'];
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];

		$usuario = Container::getModel('Usuario');
		$usuario->id = $_SESSION['id'];
		$idProprietario = $usuario->getIdProprietarioPorIdUsuario();


		$imovel = Container::getModel('Imovel');
		$imovel->fk_id_proprietario = $idProprietario['id'];
		$imoveis = $imovel->getImoveisPorProprietario();

		$this->view->imoveis = $imoveis;

		$this->render('meus_imoveis','layout_app');
	}
	
}