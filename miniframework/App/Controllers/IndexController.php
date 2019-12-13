<?php

namespace App\Controllers;

use MF\Controller\Action;
use App\Connection;
use App\Models\Produto;

class IndexController extends Action{

	public function index() {
		//$this->view->dados = array('sofa','cama', 'cadeira');
		
		//instancia de conexão
		$conn = Connection::getDb();
		//instancia de modelo
		$produto = new Produto($conn);

		$produtos = $produto->getProdutos();

		$this->view->dados = $produtos;

		$this->render('index', 'layout1');
	}

	public function sobreNos() {
		//$this->view->dados = array('smarthphone', 'notebook');
		$this->render('sobreNos', 'layout1');
	}
}

?>