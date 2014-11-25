<?php

require_once(WWW_ROOT . 'controller' . DIRECTORY_SEPARATOR . 'Controller.php');
require_once(WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'ProjectDAO.php');

class ProjectsController extends Controller {

	private $projectDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
	}

	public function index(){

	}

}
