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
		
		if (!empty($_GET['q'])) {
			$this->set("searchResult", $this->projectDAO->selectByNaam($_GET['q']));
		}

		$this->trace($_SESSION['user']['email']);
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

						$invite = $this->projectDAO->insertInvite(array(
								"project_name"=>$_POST['nieuwProjectNaam'] ,
								"invited_user_name"=>$_SESSION['user']['email'],
								"accepted"=>"1"
						));

						if(!empty($_POST['invited'])){

							$invite = $this->projectDAO->insertInvite(array(
								"project_name"=>$_POST['nieuwProjectNaam'] ,
								"invited_user_name"=>$_POST['invited'],
								"accepted"=>"1"
							));
						}

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
		

	}



	public function board() {

		$existingTekst = $this->projectDAO->getTekstForProject($_GET['name']);
		$existingImg = $this->projectDAO->getImgForProject($_GET['name']);
		$existingVideo = $this->projectDAO->getVideoForProject($_GET['name']);
		$allUsers = $this->projectDAO->getUsersForProject($_GET['name']);
		$this->set('existingTekst', $existingTekst);
		$this->set('existingImg', $existingImg);
		$this->set('existingVideo', $existingVideo);
		$this->set('allUsers', $allUsers);

		if(!empty($_POST['action'])) {
			if($_POST['action'] == 'nieuwtekst') {
				$tekst = true;
				$this->_nieuwtekst();
				$this->projectDAO->getTekstForProject($_GET['name']);
				$this->redirect("index.php?page=board&name=" . $_GET['name']);
			} else if($_POST['action'] == 'uploadimg') {

				$this->_uploadimage();
				$this->redirect("index.php?page=board&name=" . $_GET['name']);
			} else if($_POST['action'] == 'upload') {

				$this->_uploadVideo();
				$this->redirect("index.php?page=board&name=" . $_GET['name']);

			} else if($_POST['action'] == 'toevoegen'){

				if(!empty($_POST['invited'])){

					$invite = $this->projectDAO->insertInvite(array(
						"project_name"=>$_GET['name'] ,
						"invited_user_name"=>$_POST['invited'],
						"accepted"=>"1"
					));
				}

			}
		}


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

public function _uploadimage(){

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
			$imageresize->save(WWW_ROOT."uploads/images".DS.$name.".".$extension);

					// $imageresize->resizeToHeight(200);
					// $imageresize->save(WWW_ROOT."uploads".DS.$name."_th.".$extension);



					move_uploaded_file($_FILES['image']["tmp_name"], WWW_ROOT."uploads/images".DS.$_FILES["image"]["name"]);
					$image = $this->projectDAO->insertimage(array(
						"project"=>$_GET['name'] ,
						"photo"=>$name,
						"extension"=>$extension
					));
	
				}
			}
			if (!empty($errors)) {
				$_SESSION['error'] = "Nieuwe image kon niet worden aangemaakt";
				$this->set("errors", $errors);
			}

		}


}
