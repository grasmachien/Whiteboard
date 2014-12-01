<?php

require_once(WWW_ROOT . 'controller' . DIRECTORY_SEPARATOR . 'Controller.php');
require_once(WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'ProjectDAO.php');
require_once WWW_ROOT . 'php-image-resize' . DS . 'ImageResize.php';

class ProjectsController extends Controller {

	private $projectDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
	}

	public function index() {
		$this->set('projecten', $this->projectDAO->selectAllFromUser($_SESSION['user']['id']));
	}

	public function createProject() {
		$erros = array();
		$size = array();

		if (!empty($_SESSION['user'])) {
			
			if (!empty($_POST)) {
				if (empty($_POST['nieuwProjectNaam'])) {
					$errors['nieuwProjectNaam'] = "Vul een project naam in";
				}
				if (!empty($_FILES['image'])) {
					
					if (!empty($_FILES['image']['error'])) {
						$errors['image'] = "Profielfoto kon niet worden toegevoegd";
					}

					if (empty($errors['image'])) {
						$size = getimagesize($_FILES['image']['tmp_name']);
						if (empty($size)) {
							$errors['image'] = "Profielfoto kon niet worden toegevoegd";
						}
					}
					if (empty($errors)) {
						$name = preg_replace("/\\.[^.\\s]{3,4}$/", "", $_FILES["image"]["name"]);
						$extension = explode($name.".", $_FILES["image"]["name"])[1];
					
						$imageresize = new Eventviva\ImageResize($_FILES['image']['tmp_name']);
						$imageresize->save(WWW_ROOT."uploads".DS.$name.".".$extension);

						$imageresize->resizeToHeight(200);
						$imageresize->save(WWW_ROOT."uploads".DS.$name."_th.".$extension);


						move_uploaded_file($_FILES['image']["tmp_name"], WWW_ROOT."uploads".DS.$_FILES["image"]["name"]);
						$project = $this->projectDAO->insert(array(
							"name"=>$_POST['nieuwProjectNaam'] ,
							"photo"=>$name,
							"extension"=>$extension,
							"user_id"=>$_SESSION['user']['id']
						));
						if (!empty($project)) {
							$_SESSION['info'] = "Project is aangemaakt";
							$name = $_POST['nieuwProjectNaam'];
							$this->redirect('index.php?page=board&name='.$name);
						} else {
							$_SESSION['error'] = "Project is niet aangemaakt";
							$this->set("errors", $this->projectDAO->getValidationErrors($_POST));
						}
					}
				}
				if (!empty($errors)) {
					$_SESSION['error'] = "Nieuw project kon niet worden aangemaakt";
					$this->set("errors", $errors);
				}
				
			}
		}
	

		// if(!empty($_POST['action'])){

		// 	$insertedproject = $this->projectDAO->insert(array(
		// 		'nieuwProjectNaam' => $_POST['nieuwProjectNaam']
		// 	));
		// 	if(!empty($insertedproject)) {

		// 		$name = $_POST['nieuwProjectNaam'];
		// 		$this->redirect('index.php?page=board&name='.$name);
		// 	}
			
			
		// }

		// if (!empty($_SESSION['user'])) {
		// 	if (!empty($_POST)) {
		// 		if (empty($_POST['nieuwProjectNaam'])) {
		// 			$errors['nieuwProjectNaam'] = "Geef een project naam in";
		// 		}
		// 		if (empty($_POST['nieuwProjectNaam'])) {
		// 			$errors['nieuwProjectNaam'] = "Geef een project naam in";
		// 		}
			
		// 	}
		// }

		

	}

	public function board() {

		$existingTekst = $this->projectDAO->getTekstForProject($_GET['name']);
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
