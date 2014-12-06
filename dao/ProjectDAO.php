<?php

require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class ProjectDAO extends DAO {


	public function selectAllFromUser($user_email){
		$sql = "SELECT *, whiteboard_projects.photo, whiteboard_projects.name
				FROM whiteboard_invites
				LEFT JOIN whiteboard_projects
				ON whiteboard_projects.name = whiteboard_invites.project_name
				WHERE accepted = :accepted
				AND whiteboard_invites.invited_user_name = :user_email";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_email', $user_email);
		$stmt->bindValue(':accepted', '1');
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$errors = $this->getValidationErrors($data);

		if(empty($errors)) {
			$sql = "INSERT INTO `whiteboard_projects` (`name`, `photo`,`user_id`, `extension`) 
				VALUES (:name, :photo, :user_id, :extension)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':name', $data['name']);
			$stmt->bindValue(':photo', $data['photo']);
			$stmt->bindValue(':user_id', $data['user_id']);
			$stmt->bindValue(':extension', $data['extension']);
			

			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function insertInvite($data) {
		//$errors = $this->getValidationErrors($data);

		if(empty($errors)) {
			$sql = "INSERT INTO `whiteboard_invites` (`project_name`, `invited_user_name`,`accepted`) 
				VALUES (:project_name, :invited_user_name, :accepted)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':project_name', $data['project_name']);
			$stmt->bindValue(':invited_user_name', $data['invited_user_name']);
			$stmt->bindValue(':accepted', $data['accepted']);

			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}


	public function getValidationErrors($data) {
		$errors = array();
		if(empty($data['name'])) {
			$errors['name'] = 'Please enter the name';
		}
		if(empty($data['photo'])) {
			$errors['photo'] = 'Please enter the photo of the file';
		}
		if(empty($data['user_id'])) {
			$errors['user_id'] = 'Please enter the user_id of the file';
		}
		if(empty($data['extension'])) {
			$errors['extension'] = 'Please enter the user_id of the file';
		}
		return $errors;
	}


	public function inserttekst($data) {
		if(empty($errors)) {
			$sql = "INSERT INTO `whiteboard_tekst` (`tekst`, `project`) VALUES (:tekst, :project)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':tekst', $data['nieuwtekst']);
			$stmt->bindValue(':project', $_GET["name"]);
			if($stmt->execute()) {
				
	
			}
		}
		return false;
	}

	public function insertimage($data) {
		if(empty($errors)) {
			$sql = "INSERT INTO `whiteboard_img` (`project`, `photo`, `extension`) VALUES (:project, :photo, :extension)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':project', $data['project']);
			$stmt->bindValue(':photo', $data["photo"]);
			$stmt->bindValue(':extension', $data["extension"]);
			if($stmt->execute()) {
				
	
			}
		}
		return false;
	}

	public function addnew($name,$video){
        return $this->newVideo($name,$video);
    }

    public function newVideo($name,$video){
            $sql = "INSERT INTO whiteboard_video(name,video,project)
                    VALUES(:name,:video,:project)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":name",$name);
            $stmt->bindValue(":video",$video);
            $stmt->bindValue(":project",$_GET["name"]);
            if($stmt->execute()){
            }
            return false;
    }

	public function getTekstForProject($project) {
		$sql = "SELECT * FROM `whiteboard_tekst` WHERE `project` = :project";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project', $project);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getImgForProject($project) {
		$sql = "SELECT * FROM `whiteboard_img` WHERE `project` = :project";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project', $project);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getVideoForProject($project) {
		$sql = "SELECT * FROM `whiteboard_video` WHERE `project` = :project";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project', $project);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `whiteboard_projects` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}


}
