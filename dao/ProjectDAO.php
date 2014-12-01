<?php

require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class ProjectDAO extends DAO {


	public function selectAllFromUser($user_id){
		$sql = "SELECT * FROM `whiteboard_projects` WHERE `user_id` = :user_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
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
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
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

	public function selectById($id) {
		$sql = "SELECT * FROM `whiteboard_projects` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}


}
