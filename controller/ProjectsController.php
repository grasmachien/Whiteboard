<?php

require_once(WWW_ROOT . 'controller' . DIRECTORY_SEPARATOR . 'Controller.php');
require_once(WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'ProjectDAO.php');
require_once WWW_ROOT . 'php-image-resize' . DS . 'ImageResize.php';

class ProjectsController extends Controller {

	private $projectDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
	}

	public function invites(){

		$existingTekst = $this->projectDAO->getTekstForProject($_GET['name']);
		$existingImg = $this->projectDAO->getImgForProject($_GET['name']);
		$existingVideo = $this->projectDAO->getVideoForProject($_GET['name']);
		$allUsers = $this->projectDAO->getUsersForProject($_GET['name']);

		$result = array(
			'postits' => $existingTekst,
			'images' => $existingImg,
			'video' => $existingVideo,
			'users' => $allUsers,
		);

		header('Content-Type: application/json');
	    echo json_encode($result);
	    die();
	}

	public function index() {

		$this->set('projecten', $this->projectDAO->selectAllFromUser($_SESSION['user']['email']));
		
		if (!empty($_GET['q'])) {
			$this->set("searchResult", $this->projectDAO->selectByNaam($_GET['q']));
		}

		$this->trace($_SESSION['user']['email']);
		$Notifications = $this->projectDAO->getNotifications($_SESSION['user']['id']);
		$CountedNotification = count($Notifications);
		$this->set('CountedNotification', $CountedNotification);

		if(!empty($_POST['action'])) {
			if($_POST['action'] == 'request_invite') {
				$this->_insertRequest();
			} 
		}
	}

	public function notifications() {
		$Notifications = $this->projectDAO->getNotifications($_SESSION['user']['id']);
		$this->set('Notifications', $Notifications);
		$CountedNotification = count($Notifications);
		$this->set('CountedNotification', $CountedNotification);

		if(!empty($_POST['action'])) {

			if($_POST['action'] == 'toestaan') {
				
				$this->projectDAO->updateInvite($_POST['invitedid']);
				$this->redirect("index.php?page=notifications");

			} else if($_POST['action'] == 'verwijderen') {

				$this->projectDAO->deleteInvite($_POST['invitedid']);
				$this->redirect("index.php?page=notifications");

			}
		}
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


		$Notifications = $this->projectDAO->getNotifications($_SESSION['user']['id']);
		$CountedNotification = count($Notifications);
		$this->set('CountedNotification', $CountedNotification);

		$existingTekst = $this->projectDAO->getTekstForProject($_GET['name']);
		$existingImg = $this->projectDAO->getImgForProject($_GET['name']);
		$existingVideo = $this->projectDAO->getVideoForProject($_GET['name']);
		$allUsers = $this->projectDAO->getUsersForProject($_GET['name']);
		$this->set('existingTekst', $existingTekst);
		$this->set('existingImg', $existingImg);
		$this->set('existingVideo', $existingVideo);
		$this->set('allUsers', $allUsers);

		if(!empty($_POST['action'])) {
			if($_POST['action'] == 'plaats postit') {
				$this->_nieuwtekst();
				$this->projectDAO->getTekstForProject($_GET['name']);
				$this->redirect("index.php?page=board&name=" . $_GET['name']);
			} else if($_POST['action'] == 'plaats img') {

				$this->_uploadimage();
				$this->redirect("index.php?page=board&name=" . $_GET['name']);
			} else if($_POST['action'] == 'plaats video') {

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

	public function _insertRequest() {

		$nieuwInvite = $this->projectDAO->insertRequest(array(
			'projectnaam' => $_POST['projectnaam']
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

	public function postxy(){


		$confirm = true;
	  	$errors = array();
	  	$data = $_POST;
	  	$confirm = false;

	  	if($data){

	  		if($data['tabel'] == "whiteboard_img"){
	  			$inserted_post = $this->projectDAO->updatexy($data);
	  		}else if($data['tabel'] == "whiteboard_tekst"){
				$inserted_post = $this->projectDAO->updatexytxt($data);
	  		}else if($data['tabel'] == "whiteboard_video"){
				$inserted_post = $this->projectDAO->updatexyvid($data);
	  		}
		  	
				if(!$inserted_post){
					// $errors = $this->postDAO->getValidationErrors($data);
			        // header('Content-Type: application/json');
			        // echo json_encode(array('result' => false, 'errors' => $errors));
			        // die();
				}else{
	        
					$confirm = true;
					// $this->redirect("index.php?page=posts");
	        
	        header('Content-Type: application/json');
	        echo json_encode(array('result' => true));
	        die();
				}
	  	}

	  	$this->set("data", $data);
	  	$this->set("confirm", $confirm);
		$this->set("errors", $errors);

  	}

  	public function postpostit(){

		$confirm = true;
	  	$errors = array();
	  	$data = $_POST;
	  	$confirm = false;

	  	if($data){

	  // 		$insertedtekst = $this->projectDAO->inserttekst(array(
			// 'nieuwtekst' => $_POST['tekst']
			// ));

			$inserted_post = $this->projectDAO->inserttekst($data);
		  	
			if(!$inserted_post){
				// $errors = $this->postDAO->getValidationErrors($data);
		        // header('Content-Type: application/json');
		        // echo json_encode(array('result' => false, 'errors' => $errors));
		        // die();
			}else{
        
				$confirm = true;
				// $this->redirect("index.php?page=posts");
	        
	        header('Content-Type: application/json');
	        echo json_encode(array('result' => true));
	        die();
				}
	  	}

	  	$this->set("data", $data);
	  	$this->set("confirm", $confirm);
		$this->set("errors", $errors);

  	}

  	public function deletepostit(){

		$confirm = true;
	  	$errors = array();
	  	$data = $_POST;
	  	$confirm = false;

	  	if($data){

	  // 		$insertedtekst = $this->projectDAO->inserttekst(array(
			// 'nieuwtekst' => $_POST['tekst']
			// ));

			

			if($data['tabel'] == "whiteboard_img"){
	  			$inserted_post = $this->projectDAO->deleteimg($data);
	  		}else if($data['tabel'] == "whiteboard_tekst"){
				$inserted_post = $this->projectDAO->deletetekst($data);
	  		}else if($data['tabel'] == "whiteboard_video"){
				$inserted_post = $this->projectDAO->deletevideo($data);
	  		}
		  	
			if(!$inserted_post){
				// $errors = $this->postDAO->getValidationErrors($data);
		        // header('Content-Type: application/json');
		        // echo json_encode(array('result' => false, 'errors' => $errors));
		        // die();
			}else{
        
				$confirm = true;
				// $this->redirect("index.php?page=posts");
	        
	        header('Content-Type: application/json');
	        echo json_encode(array('result' => true));
	        die();
				}
	  	}

	  	$this->set("data", $data);
	  	$this->set("confirm", $confirm);
		$this->set("errors", $errors);

  	}

  	public function uploadimg(){
  		$data = $_POST;

  		if($_POST['action'] == 'plaats img'){
  			
  			$name = preg_replace("/\\.[^.\\s]{3,4}$/", "", $_FILES["image"]["name"]);
			$extension = explode($name.".", $_FILES["image"]["name"])[1];

			$imageresize = new Eventviva\ImageResize($_FILES['image']['tmp_name']);
			$imageresize->save(WWW_ROOT."uploads/images".DS.$name.".".$extension);

			move_uploaded_file($_FILES['image']["tmp_name"], WWW_ROOT."uploads/images".DS.$_FILES["image"]["name"]);
			$image = $this->projectDAO->insertimage(array(
				"project"=>$_POST['project'] ,
				"photo"=>$name,
				"extension"=>$extension
			));

  		}

  	}

  	public function uploadvideo(){
  		$data = $_POST;

  		if($_POST['action'] == 'plaats video'){

  			if(!empty($_POST["name"])
			&& !empty($_FILES["videofile"])){

			$type = ($_FILES["videofile"]["type"]);
			$path = $_FILES["videofile"]["tmp_name"];
			$size = filesize($path);
			$project = $_POST['project'];

			if($type == "video/mp4" && $size <=10000000){

				$filename = $_POST["name"].".mp4";
				$newPath = WWW_ROOT.'uploads'.DS.$filename;

				move_uploaded_file($path,$newPath);

				$image = $this->projectDAO->newVideo(array(
				"project"=>$_POST['project'] ,
				"filename"=>$filename,
				"name"=>$_POST["name"]
			));
			}
		}


  		}

  	}

}
