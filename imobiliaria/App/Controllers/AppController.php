<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action{

	public function timeline(){

		//$this->validaAutenticacao();

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

		$imovel = Container::getModel('Imovel');
		$imoveis = $imovel->getAll();

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
		$imovel = Container::getModel('Imovel');

		echo "<pre>";
		print_r($_POST);
		echo "</pre>";

		$imovel->fk_id_proprietario = 1;
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
		
		print_r($_FILES);

		//$imovel->salvar();

		//$this->view->erroCadastro = true;
		$this->render('cadastrar_imovel');

	}

	public function cadastrar_imovel(){
		$this->view->erroCadastro = false;
		$this->render('cadastrar_imovel');
	}
	
}

