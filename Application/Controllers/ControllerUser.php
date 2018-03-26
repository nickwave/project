<?php
use Application\Core\Controller;
use Application\Core\View;

class ControllerUser extends Controller
{

	function __construct()
	{
		$this->model = new ModelUser();
		$this->view = new View();
	}
	
	function actionIndex()
	{
		$data = $this->model->getData();
		$this->view->generate('userView.php', 'templateView.php', 'Users', $data);
	}
}