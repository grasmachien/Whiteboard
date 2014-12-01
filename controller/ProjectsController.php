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

		if(!empty($_POST['action'])){

			$insertedproject = $this->projectDAO->insert(array(
				'nieuwProjectNaam' => $_POST['nieuwProjectNaam']
			));
			if(!empty($insertedproject)) {

				$name = $_POST['nieuwProjectNaam'];
				$this->redirect('index.php?page=board&name='.$name);
			}
			
			
		}

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

	public function board() {

		$existingTekst = $this->projectDAO->getTekstForProject($_GET['name']);
		$this->trace($existingTekst);
		$this->set('existingTekst', $existingTekst);

		if(!empty($_POST['action'])) {
			if($_POST['action'] == 'nieuwtekst') {
				$this->_nieuwtekst();
			} else if($_POST['action'] == 'postit') {
				var_dump('postit');
			} else if($_POST['action'] == 'foto') {
				var_dump('foto');
			} else if($_POST['action'] == 'video') {
				var_dump('video');
			}
		}

	}

	public function _nieuwtekst() {

		$insertedtekst = $this->projectDAO->inserttekst(array(
				'nieuwtekst' => $_POST['nieuwtekst']
			));

	}


}
