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

	public function getNotifications($user_id) {
		$sql = "SELECT *, whiteboard_projects.photo, whiteboard_projects.name
				FROM whiteboard_invites
				LEFT JOIN whiteboard_projects
				ON whiteboard_projects.name = whiteboard_invites.project_name
				WHERE accepted = :accepted
				AND whiteboard_projects.user_id = :user_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':accepted','0');
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getUsersForProject($project) {
		$sql = "SELECT * FROM `whiteboard_invites` WHERE `project_name` = :project_name AND accepted = :accepted";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_name', $project);
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

	public function insertRequest($data) {
		//$errors = $this->getValidationErrors($data);

		if(empty($errors)) {
			$sql = "INSERT INTO `whiteboard_invites` (`project_name`, `invited_user_name`,`accepted`) 
				VALUES (:project_name, :invited_user_name, :accepted)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':project_name', $data['projectnaam']);
			$stmt->bindValue(':invited_user_name', $_SESSION['user']['email']);
			$stmt->bindValue(':accepted', '0');

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
			$errors['extension'] = 'Please enter the extension of the file';
		}
		return $errors;
	}


	public function inserttekst($data) {
		if(empty($errors)) {
			$sql = "INSERT INTO `whiteboard_tekst` (`tekst`, `project`, `x`, `y`) VALUES (:tekst, :project, :x, :y)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':tekst', $data['tekst']);
			$stmt->bindValue(':project', $data['project']);
			$stmt->bindValue(":x","200");
      		$stmt->bindValue(":y","200");	
			if($stmt->execute()) {
				
			}
		}
		return false;
	}

	public function insertimage($data) {
		if(empty($errors)) {
			$sql = "INSERT INTO `whiteboard_img` (`project`, `photo`, `extension`, `x`, `y`) VALUES (:project, :photo, :extension, :x, :y)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':project', $data['project']);
			$stmt->bindValue(':photo', $data["photo"]);
			$stmt->bindValue(':extension', $data["extension"]);
      		$stmt->bindValue(":x","200");
     		$stmt->bindValue(":y","200");			
			if($stmt->execute()) {
				
			}
		}
		return false;
	}


    public function newVideo($data){
            $sql = "INSERT INTO whiteboard_video(name,video,project, x, y)
                    VALUES(:name,:video,:project, :x, :y)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":name",$data['name']);
            $stmt->bindValue(":video",$data['filename']);
            $stmt->bindValue(":project",$data['project']);
            $stmt->bindValue(":x","200");
            $stmt->bindValue(":y","200");
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

	public function selectById($id){
		$sql = "SELECT * FROM `whiteboard_projects` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function deleteInvite($id){

        $sql = "DELETE FROM `whiteboard_invites`
                WHERE invite_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function deletetekst($data){

        $sql = "DELETE FROM `whiteboard_tekst`
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $data['id']);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function deleteimg($data){

        $sql = "DELETE FROM `whiteboard_img`
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $data['id']);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function deletevideo($data){

        $sql = "DELETE FROM `whiteboard_video`
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $data['id']);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

     public function updateInvite($id){

        $sql = 'UPDATE whiteboard_invites
                    SET accepted = :accepted
                    WHERE invite_id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':accepted', '1');
        if($stmt->execute()){
            return $this->getNotifications($_SESSION['user']['id']);
        }
        return array();
    }

  	public function updatexy($data){

        $sql = 'UPDATE whiteboard_img
                    SET x = :x , y = :y
                    WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':x', $data['x']);
        $stmt->bindValue(':y', $data['y']);
        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();
    }

    public function updatexytxt($data){

        $sql = 'UPDATE whiteboard_tekst
                    SET x = :x , y = :y
                    WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':x', $data['x']);
        $stmt->bindValue(':y', $data['y']);
        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();
    }

    public function updatexyvid($data){

        $sql = 'UPDATE whiteboard_video
                    SET x = :x , y = :y
                    WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':x', $data['x']);
        $stmt->bindValue(':y', $data['y']);
        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();
    }

    

	public function selectByNaam($naam){
		$sql = "SELECT *
				FROM `whiteboard_projects`
				WHERE (`name` LIKE :naam)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":naam", "%".$naam."%");

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


}
