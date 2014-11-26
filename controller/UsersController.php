<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'UserDAO.php';

require_once WWW_ROOT . 'phpass' . DS . 'Phpass.php';

class UsersController extends Controller {

	private $userDAO;

	function __construct() {
		$this->userDAO = new UserDAO();
	}

	public function loginregister() {
		if(!empty($_POST['action'])) {
			if($_POST['action'] == 'Login') {
				$this->_handleLogin();
			} else if($_POST['action'] == 'Register') {
				$this->_handleRegister();
			}
		}
	}

	private function _handleLogin() {
		$errors = array();
		if(empty($_POST['loginEmail'])) {
			$errors['loginEmail'] = 'Please enter your email';
		}
		if(empty($_POST['loginPassword'])) {
			$errors['loginPassword'] = 'Please enter your password';
		}
		if(empty($errors)) {
			$existing = $this->userDAO->selectByEmail($_POST['loginEmail']);
			if(!empty($existing)) {
				$hasher = new \Phpass\Hash;
				if ($hasher->checkPassword($_POST['loginPassword'], $existing['password'])) {
					$_SESSION['user'] = $existing;
					$this->redirect('index.php');
				} else {
					$_SESSION['error'] = 'Unknown username / password';
				}
			} else {
				$_SESSION['error'] = 'Unknown username / password';
			}
		} else {
			$_SESSION['error'] = 'Unknown username / password';
		}
		$this->set('errors', $errors);
	}

	private function _handleRegister() {
		$errors = array();
		if(empty($_POST['registerEmail'])) {
			$errors['registerEmail'] = 'Please enter your email';
		} else {
			$existing = $this->userDAO->selectByEmail($_POST['registerEmail']);
			if(!empty($existing)) {
				$errors['registerEmail'] = 'Email address is already in use';
			}
		}
		if(empty($_POST['registerPassword'])) {
			$errors['registerPassword'] = 'Please enter a password';
		}
		if($_POST['registerPassword2'] != $_POST['registerPassword']) {
			$errors['registerPassword2'] = 'Passwords do not match';
		}
		if(empty($errors)) {
			$hasher = new \Phpass\Hash;
			$inserteduser = $this->userDAO->insert(array(
				'email' => $_POST['registerEmail'],
				'password' => $hasher->hashPassword($_POST['registerPassword'])
			));
			if(!empty($inserteduser)) {
				$_SESSION['info'] = 'Registration Successful!';
				$_SESSION['user'] = $inserteduser;
				$this->redirect('index.php');
			}
		}
		$_SESSION['error'] = 'Registration Failed!';
		$this->set('errors', $errors);
	}

	public function logout(){
		unset($_SESSION['user']);
		$this->redirect('index.php');
	}

}