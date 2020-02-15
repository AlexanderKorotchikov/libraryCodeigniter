<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('index_model');
	}

	public function index()
	{
		if (isset($_POST['add_author'])) {
			unset($_POST['add_author']);
			if ($this->validator->indexValid($_POST)) {
				if ($this->index_model->addAuthor($_POST)) {
					$_SESSION['error'] = '';
					header('Location: /');
					exit();
				} else {
					$_SESSION['error'] = 'Ошибка сохранения!';
					header("Location: /");
					exit();
				}
			} else {
				$_SESSION['error'] = 'Заполните поля правильно!';
				header("Location: /");
				exit();
			}
		} elseif (isset($_POST['add_genre'])) {
			unset($_POST['add_genre']);
			if ($this->validator->indexValid($_POST)) {
				if ($this->index_model->addGenre($_POST)) {
					$_SESSION['error'] = '';
					header('Location: /');
					exit();
				} else {
					$_SESSION['error'] = 'Ошибка сохранения!';
					header("Location: /");
					exit();
				}
			} else {
				$_SESSION['error'] = 'Заполните поля правильно!';
				header("Location: /");
				exit();
			}
		} elseif (isset($_POST['add_book'])) {
			unset($_POST['add_book']);

			$_POST['picture'] = $_FILES['picture']['name'];
			if (!isset($_POST['authors']) || !isset($_POST['genres']) || !isset($_FILES['picture']['name'])) {
				$_SESSION['error'] = 'Заполните поля правильно!';
				header("Location: /");
				exit();
			}
			if (!$this->uploadfile->do_upload($_FILES)) {
				$_SESSION['error'] = 'Фото не удалось загрузить!';
			}

			if ($this->validator->indexValid($_POST)) {
				if ($this->index_model->addBook($_POST)) {
					$_SESSION['error'] = '';
					header('Location: /');
					exit();
				} else {
					$_SESSION['error'] = 'Ошибка сохранения!';
					header("Location: /");
					exit();
				}
			} else {
				$_SESSION['error'] = 'Заполните поля правильно!';
				header("Location: /");
				exit();
			}
		}
		$data['authors'] = $this->index_model->getAuthors();
		$data['genres'] = $this->index_model->getGenre();
		$this->load->view('home_page', $data);
	}

}
