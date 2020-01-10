<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

//os models
use MF\Models\Produto;
use MF\Models\Info;

class IndexController extends Action {

	public function index() {

		$this->render('index');
	}
		public function sobreNos() {

		$info = Container::getModel('info');

		$informacoes = $info->getInfo();

		$this->view->dados = $informacoes;

		$this->render('sobreNos');
	}

}


?>