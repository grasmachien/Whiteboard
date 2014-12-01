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

		$video = false;
		$tekst = false;

		$existingTekst = $this->projectDAO->getTekstForProject($_GET['name']);
		$existingVideo = $this->projectDAO->getVideoForProject($_GET['name']);
		$this->set('existingTekst', $existingTekst);
		$this->set('existingVideo', $existingVideo);

		if(!empty($_POST['action'])) {
			if($_POST['action'] == 'nieuwtekst') {
				$tekst = true;
				$this->_nieuwtekst();
				$this->projectDAO->getTekstForProject($_GET['name']);

			} else if($_POST['action'] == 'postit') {
				var_dump('postit');
			} else if($_POST['action'] == 'foto') {
				var_dump('foto');
			} else if($_POST['action'] == 'upload') {
				$this->_uploadVideo();
			}
		}

		$this->set('video', $video);
		$this->set('tekst', $tekst);

	}

	public function _nieuwtekst() {

		$insertedtekst = $this->projectDAO->inserttekst(array(
				'nieuwtekst' => $_POST['nieuwtekst']
			));

	}

	public function _uploadVideo(){
		if(!empty($_POST["name"])
                    && !empty($_FILES["videofile"])){

                    $type = ($_FILES["videofile"]["type"]);
               		$path = $_FILES["videofile"]["tmp_name"];
                    $size = filesize($path);

                    if($type == "video/mp4" && $size <=10000000){

                        $filename = $_POST["name"].".mp4";
                        $newPath = WWW_ROOT.'uploads'.DS.$filename;

                        move_uploaded_file($path,$newPath);

                        $this->projectDAO->addnew($_POST["name"],$filename);


                	}

                }
	}


}
