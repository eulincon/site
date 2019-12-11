<?php

namespace App\Controllers;

class IndexController {

	private $view;

	public function __construct() {
		$this->view = new \stdClass();
	}

	public function index() {
		$this->view->dados = array('sofa','cama', 'cadeira');
		$this->render('index');
	}

	public function sobreNos() {
		$this->view->dados = array('smarthphone', 'notebook');
		$this->render('sobreNos');
	}

	public function render($view) {
		$classAtual = get_class($this);
		$classAtual = str_replace('App\\Controllers\\', '', $classAtual);
		$classAtual = strtolower(str_replace('Controller', '', $classAtual));
		require_once "../App/Views/".$classAtual."/".$view.".phtml";

	}
}


?>