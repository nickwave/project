<?php
use Application\Core\Controller;

class ControllerHome extends Controller
{
	function actionIndex()
	{	
		$this->view->generate('homeView.php', 'templateView.php', 'Home');
	}
}