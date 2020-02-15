<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BooksController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('books_model');
		$this->load->model('index_model');
	}

	public function index($page = 1)
	{
		$booksList = $this->books_model->getBooksList($page);
		$data['count_page'] = $booksList['count_page'];
		unset($booksList['count_page']);
		$data['booksList'] = $booksList;

		$this->load->view('books/books', $data);
	}

	public function view($id)
	{
		if ($id) {
			$data['bookList'] = $this->books_model->getBooksListById($id);
			$this->load->view('books/view', $data);
		}
		return true;
	}

	public function edit($id)
	{
		if (isset($_POST['edit'])) {

			if (!isset($_POST['authors']) || !isset($_POST['genres'])) {
				$_SESSION['error_edit'] = 'Заполните поля правильно!';
				header("Location: /books/edit/$id");
				exit();
			}

			if (!isset($_FILES['picture']['name']) || $_FILES['picture']['name'] == '') {
				$_POST['picture'] = explode('/', $_POST['picture_old'])[2];
			} else {
				$_POST['picture'] = $_FILES['picture']['name'];
				if (!$this->uploadfile->do_upload($_FILES)) {
					return false;
				}
			}

			if ($this->validator->indexValid($_POST)) {
				if ($this->books_model->editBook($id, $_POST)) {
					$_SESSION['error_edit'] = '';
					header("Location: /books/$id");
					exit();
				} else {
					$_SESSION['error_edit'] = 'Ошибка сохранения!';
					header("Location: /books/edit/$id");
					exit();
				}
			} else {
				$_SESSION['error_edit'] = 'Заполните поля правильно!';
				header("Location: /books/edit/$id");
				exit();
			}

			return true;
		}

		if ($id) {
			$data['bookList'] = $this->books_model->getBooksListById($id);
			$data['authors'] = $this->index_model->getAuthors();
			$data['genres'] = $this->index_model->getGenre();
			$this->load->view('books/edit', $data);
		}
	}

}
