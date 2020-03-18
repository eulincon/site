<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

		$imovel = Container::getModel('Imovel');
		$imoveis = $imovel->getImoveisMostrarNaIndex();

		$this->view->imoveis = $imoveis;
		
		$this->render('index');
	}

	public function login(){
		$this->view->usuario = array(
			'nome' => '',
			'email' => '',
			'senha' => ''
		);
		$this->view->erroCadastro = false;
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('login');
	}


	public function inscreverse() {
		$this->view->usuario = array(
			'nome' => '',
			'telefone' => '',
			'email' => '',
			'senha' => ''
		);
		$this->view->erroCadastro = false;
		$this->render('inscreverse');
	}


	public function registrar() {
		//receber os dados do formulario
		$usuario = Container::getModel('Usuario');

		if(file_exists($_FILES['imagem_perfil']['tmp_name'])){
			$usuario->imagem_perfil = $_FILES['imagem_perfil'];
		}
		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('telefone', $_POST['telefone']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));

		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0){
	
			if($usuario->salvar()){
				header('Location: /login');
			}

		}else{
			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'telefone' => $_POST['telefone'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha']
			);
			$this->view->erroCadastro = true;
			$this->render('inscreverse');
		}
	}

	public function error_notfound(){
		$this->render('error_notfound','layout_error');
	}

	public function imagem(){
		$this->render('imagem');
	}

	public function upar_imagem(){

		$imagem = Container::getModel('Imagem');
	
		$imagem->__set('imagem',$_FILES['imagem']);

		$imagem->salvar();

		//$imagem->retornarImagem();

		$this->render('ver_imagem');
	}

	public function ver_imagem(){
		$imagem = Container::getModel('Imagem');
		$img = $imagem->retornarImagem();
		$this->view->imagem = $img;
		$this->render('ver_imagem');
	}

	public function imovel_detalhesNoUser(){
		$imovel = Container::getModel('Imovel');
		$imagens = $imovel->getImagensImovelPorId($_GET['imovel']);
		$imovel = $imovel->getImovelPorId($_GET['imovel']);

		$this->view->imovel = $imovel;
		$this->view->imagens = $imagens;

		$this->render('imovel_detalhesNoUser');
	}

}


?>