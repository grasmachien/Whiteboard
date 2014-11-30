<?php

require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class ProjectDAO extends DAO {


	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `whiteboard_projects` (`name`) VALUES (:name)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':name', $data['nieuwProjectNaam']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `whiteboard_projects` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getValidationErrors($data) {
		$errors = array();
		if(empty($data['nieuwProjectNaam'])) {
			$errors['nieuwProjectNaam'] = "Please fill in a name";
		}
		return $errors;
	}

}
