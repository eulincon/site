<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action{

	public function timeline(){

		//$this->validaAutenticacao();

		//recuperação de tweets
		//$tweet = Container::getModel('Tweet');
		//$tweet->__set('id_usuario', $_SESSION['id']);
		//$tweets = $tweet->getAll();

		//$this->view->tweets = $tweets;

		//$usuario = Container::getModel('Usuario');
		//$usuario->id = $_SESSION['id'];

		//$this->view->info_usuario = $usuario->getInfoUsuario();
		//$this->view->total_tweets = $usuario->getTotalTweets();
		//$this->view->total_seguindo = $usuario->getTotalSeguindo();
		//$this->view->total_seguidores = $usuario->getTotalSeguidores();


		$this->render('timeline');
	}

	public function imovel(){

		$this->validaAutenticacao();

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

	public function cadastrarImovel(){
		$this->view->erroCadastro = false;
		$this->render('cadastrarImovel');
	}
	
}