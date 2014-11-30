<?php

require_once(WWW_ROOT . 'controller' . DIRECTORY_SEPARATOR . 'Controller.php');
require_once(WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'ProjectDAO.php');

class ProjectsController extends Controller {

	private $projectDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
	}

	public function index() {

	}

	public function createProject() {
		$erros = array();
		$size = array();

		if (!empty($_SESSION['user'])) {
			if (!empty($_POST)) {
				if (empty($_POST['nieuwProjectNaam'])) {
					$errors['nieuwProjectNaam'] = "Geef een project naam in";
				}
				if (empty($_POST['nieuwProjectNaam'])) {
					$errors['nieuwProjectNaam'] = "Geef een project naam in";
				}
				
				
			}
		}

	}

}
