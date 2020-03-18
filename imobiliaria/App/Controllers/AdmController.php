<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AdmController extends Action{

	public function dashboard(){

		$this->validaAutenticacao();
		$this->view->nome = $_SESSION['nome'];
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];

		$imoveis = Container::getModel('Imovel');
		$imoveis = $imoveis->getImoveisPendentes();

		$this->view->qtdImoveisPendentes = count($imoveis);

		$this->render('dashboard','layout_adm');
	}

	public function validaAutenticacao(){

		session_start();

		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
			header('Location: /?login=erro');
		}
	}

	public function imoveis_pendentes(){
		$this->validaAutenticacao();
		$this->view->nome = $_SESSION['nome'];
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];

		$imoveis = Container::getModel('Imovel');
		$imoveis = $imoveis->getImoveisPendentes();

		$this->view->imoveis = $imoveis;

		$this->render('imoveis_pendentes','layout_adm');
	}

	public function imovel_avaliacao(){
		$this->validaAutenticacao();
		$this->view->nome = $_SESSION['nome'];
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];

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

		echo $acao;

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
		}elseif($acao == 'set_index'){
			$imovel->setMostrarNaIndex();
			header('Location: imoveis_home');
		}elseif($acao == 'unset_index'){
			$imovel->unsetMostrarNaIndex();
			header('Location: imoveis_home');
		}
	}

	public function acao_usuario(){

		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

		$usuario = Container::getModel('Usuario');
		$usuario->id = isset($_GET['id_c']) ? $_GET['id_c'] : '';


		if($acao == 'remover_corretor'){
			$qtdImovel = $usuario->removerCorretor();
			if($qtdImovel == 0){
				header('Location: /gerenciar_corretores');
			}else{
				header('Location: /gerenciar_corretores?erro=true&qtd='.$qtdImovel.'&id_c='.$usuario->id);
			}
		}elseif($acao == 'adicionar_corretor'){
			$usuario->adicionarCorretor();
			header('Location: /gerenciar_corretores');
		}
	}

	public function gerenciar_corretores(){
		$this->validaAutenticacao();
		$this->view->nome = $_SESSION['nome'];
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];

		$usuarios = Container::getModel('Usuario');
		$usuarios = $usuarios->getAll();

		$this->view->erro = isset($_GET['erro']) ? $_GET['erro'] : '';
		$this->view->qtdImoveis = isset($_GET['qtd']) ? $_GET['qtd'] : '';
		$this->view->id_c = isset($_GET['id_c']) ? $_GET['id_c'] : '';

		$this->view->usuarios = $usuarios;

		$this->render('gerenciar_corretores', 'layout_adm');
	}

	public function imoveis_home(){
		$this->validaAutenticacao();
		$this->view->nome = $_SESSION['nome'];
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];

		$imoveis = Container::getModel('Imovel');
		$imoveis = $imoveis->getImoveisDisponiveis();

		$this->view->imoveis = $imoveis;

		$this->render('imoveis_home','layout_adm');
	}
}