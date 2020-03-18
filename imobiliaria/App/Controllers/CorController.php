<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class CorController extends Action{

	public function dashboardC(){
		$this->validaAutenticacao();
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];
		$this->view->nome = $_SESSION['nome'];

		$imoveis = Container::getModel('Imovel');
		$imoveis->corretor_responsavel = $_SESSION['id'];
		$visitas = $imoveis->getVisitasMarcadas();
		$imoveis = $imoveis->getImoveisPendentesPorCorretor();

		$this->view->visitas = count($visitas);

		$this->view->qtdImoveis = count($imoveis);

		$this->render('dashboardC','layout_cor');
	}

	public function visitas_marcadas(){
		$this->validaAutenticacao();
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];
		$this->view->nome = $_SESSION['nome'];

		$imoveis = Container::getModel('Imovel');
		$imoveis->corretor_responsavel = $_SESSION['id'];
		$visitas = $imoveis->getVisitasMarcadas();

		$this->view->imoveis = $visitas;

		$this->render('visitas_marcadas','layout_cor');
	}

	public function acao_cor(){
		$this->validaAutenticacao();
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];
		$this->view->nome = $_SESSION['nome'];

		print_r($_POST);
		print_r($_GET);

		$imovel = Container::getModel('Imovel');
		$imovel->horario_visita = $_POST['data'];
		$imovel->id = $_GET['id_imovel'];

		$imovel->agendarVisita();

		header('Location: imoveis_para_avaliar');
	}

	public function marcar_visita(){
		$this->validaAutenticacao();
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];
		$this->view->nome = $_SESSION['nome'];

		$imovel = Container::getModel('Imovel');
		$imovel = $imovel->getImovelPorId($_GET['imovel']);

		$this->view->imovel = $imovel;

		$this->render('marcar_visita','layout_cor');

	}

	public function validaAutenticacao(){

		session_start();

		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
			header('Location: /?login=erro');
		}
	}

	public function imoveis_para_avaliar(){
		$this->validaAutenticacao();
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];
		$this->view->nome = $_SESSION['nome'];


		$imoveis = Container::getModel('Imovel');
		$imoveis->corretor_responsavel = $_SESSION['id'];
		$imoveis = $imoveis->getImoveisPendentesPorCorretor();

		$this->view->imoveis = $imoveis;
		$this->view->qtdImoveis = count($imoveis);

		$this->render('imoveis_para_avaliar','layout_cor');
	}

	public function avaliar_imovelC(){
		$this->validaAutenticacao();
		$this->view->imagem_perfil = $_SESSION['imagem_perfil'];
		$this->view->nome = $_SESSION['nome'];

		$imovel = Container::getModel('Imovel');
		$imovel = $imovel->getImovelPorId($_GET['imovel']);
		$relatorios = Container::getModel('Relatorio');
		$relatorios->fk_id_imovel = $_GET['imovel'];
		$relatorios = $relatorios->getRelatoriosPorImovel();


		$this->view->relatorios = $relatorios;
		$this->view->imovel = $imovel;

		$this->render('avaliar_imovelC','layout_cor');
	}

	public function adicionar_relatorio(){

		$imovel = Container::getModel('Imovel');
		$imovel = $imovel->getImovelPorId($_GET['id_imovel']);
		$relatorio = Container::getModel('Relatorio');
		$relatorio->fk_id_usuario = 1;
		$relatorio->fk_id_imovel = $_GET['id_imovel'];
		$relatorio->relatorio = $_POST['relatorio'];

		$relatorio->salvar();

		header('Location: /avaliar_imovelC?imovel='.$_GET['id_imovel']);
	}

	public function validar_imovelC(){
		$imovel = Container::getModel('Imovel');
		$imovel->id = $_GET['id_imovel'];
		$imovel->validarImovel();

		header('Location: /dashboardC');

	}

}