<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class CorController extends Action{

	public function dashboardC(){
		$this->render('dashboardC','layout_cor');
	}

}