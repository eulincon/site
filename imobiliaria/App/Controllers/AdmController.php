<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AdmController extends Action{

	public function dashboard(){

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

		$imoveis = Container::getModel('Imovel');
		$imoveis = $imoveis->getAll();

		$this->view->imoveis = $imoveis;

		$this->render('dashboard','layout_adm');
	}

	public function imoveis_pendentes(){

		$imoveis = Container::getModel('Imovel');
		$imoveis = $imoveis->getImoveisPendentes();

		$this->view->imoveis = $imoveis;

		$this->render('imoveis_pendentes','layout_adm');
	}

	public function imovel_avaliacao(){

		$imovel = Container::getModel('Imovel');
		$imovel = $imovel->getImovelPorId($_GET['imovel']);

		$corretores = Container::getModel('Usuario');
		$corretores = $corretores->getCorretores();

		$this->view->corretores = $corretores;
		$this->view->imovel = $imovel;

		$this->render('imovel_avaliacao','layout_adm');
	}

	public function acao_imovel(){

		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

		$imovel = Container::getModel('Imovel');
		$imovel->id = isset($_GET['id_imovel']) ? $_GET['id_imovel'] : '';
		$imovel->corretor_responsavel = isset($_GET['id_c']) ? $_GET['id_c'] : '';


		if($acao == 'set_corretor'){
			$imovel->definirCorretorResponsavel();
			header('Location: /imovel_avaliacao?imovel='.$_GET['id_imovel']);
		}else if($acao == 'unset_corretor'){
			$imovel->setNullCorretorResponsavel();
			header('Location: /imovel_avaliacao?imovel='.$_GET['id_imovel']);
		}elseif($acao == 'validar_imovel'){
			$imovel->validarImovel();
			header('Location: /imoveis_pendentes');
		}
	}

	public function acao_usuario(){

		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

		$usuario = Container::getModel('Usuario');
		$usuario->id = isset($_GET['id_c']) ? $_GET['id_c'] : '';


		if($acao == 'remover_corretor'){
			$usuario->removerCorretor();
			header('Location: /gerenciar_corretores');
		}elseif($acao == 'adicionar_corretor'){
			$usuario->adicionarCorretor();
			header('Location: /gerenciar_corretores');
		}
	}

	public function gerenciar_corretores(){
		$usuarios = Container::getModel('Usuario');
		$usuarios = $usuarios->getAll();

		$this->view->usuarios = $usuarios;

		$this->render('gerenciar_corretores', 'layout_adm');
	}
}