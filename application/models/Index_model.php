<?php

class Index_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getAuthors()
	{
		$query = $this->db->get('author');
		return $query->result_array();
	}

	public function getGenre()
	{
		$query = $this->db->get('genre');
		return $query->result_array();
	}

	public function addAuthor($data)
	{

		$mas_data = array(
			'author_name' => $data['name'],
			'author_surname' => $data['surname'],
			'author_patronymic' => $data['patronymic'],
			'author_date' => $data['date'],
		);
		return $this->db->insert('author', $mas_data);
	}

	public function addGenre($data)
	{
		return $this->db->insert('genre', $data);
	}

	public function addBook($data)
	{
		$mas_data = array(
			'books_name' => $data['name'],
			'books_picture' => $data['picture'],
			'books_description' => $data['description'],
			'books_date' => $data['date'],
		);
		if (!$this->db->insert('books', $mas_data)) return false;
		$id = $this->db->insert_id();

		$mas_authors = [];
		foreach ($data['authors'] as $author) {
			$mas_authors[] = array(
				'book_id' => $id,
				'author_id' => (int)$author
			);
		}
		if (!$this->db->insert_batch('books_authors', $mas_authors)) return false;

		$mas_genres = [];
		foreach ($data['genres'] as $genre) {
			$mas_genres[] = array(
				'book_id' => $id,
				'genre_id' => (int)$genre
			);
		}
		if (!$this->db->insert_batch('books_genres', $mas_genres)) return false;

		return true;
	}
}
