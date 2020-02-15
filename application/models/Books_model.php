<?php

class Books_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getBooksListById($id)
	{
		$id = intval($id);
		if ($id) {
			$booksList = [];
			$query = $this->db->query('SELECT b.*, GROUP_CONCAT(DISTINCT CONCAT(a.author_name, \' \' , a.author_surname, \' \', a.author_patronymic, \' (\' , a.author_date , \')\') separator \', \') authors,
										GROUP_CONCAT(DISTINCT g.genre separator \', \') genres, group_concat(DISTINCT a.author_id) author_id,
										group_concat(DISTINCT g.genre_id) genre_id
										FROM books b
											JOIN books_authors ba ON b.books_id = ba.book_id
											JOIN author a ON ba.author_id = a.author_id
											JOIN books_genres bg ON b.books_id = bg.book_id
											JOIN genre g ON bg.genre_id = g.genre_id
										WHERE b.books_id = ' . $id . '
										GROUP BY b.books_id');
			foreach ($query->result() as $row) {
				$booksList['books_id'] = $row->books_id;
				$booksList['books_name'] = $row->books_name;
				$booksList['books_picture'] = '/uploads/' . $row->books_picture;
				$booksList['books_description'] = $row->books_description;
				$booksList['books_date'] = $row->books_date;
				$booksList['authors'] = $row->authors;
				$booksList['authors_id'] = $row->author_id;
				$booksList['genres_id'] = $row->genre_id;
				$booksList['genres'] = $row->genres;
			}

			return $booksList;
		}
		return false;
	}

	public function getBooksList($page)
	{
		$booksList = array();
		$query = $this->db->query('SELECT b.*, GROUP_CONCAT(DISTINCT CONCAT(a.author_name, \' \' , a.author_surname, \' \', a.author_patronymic, \' (\' , a.author_date , \')\') separator \', \') authors,
									GROUP_CONCAT(DISTINCT g.genre separator \', \') genres
									FROM books b
										JOIN books_authors ba ON b.books_id = ba.book_id
										JOIN author a ON ba.author_id = a.author_id
										JOIN books_genres bg ON b.books_id = bg.book_id
										JOIN genre g ON bg.genre_id = g.genre_id
									GROUP BY b.books_id
									LIMIT ' . NUM_BOOKS * ($page - 1) . ', ' . NUM_BOOKS);

		foreach ($query->result() as $row) {
			$id = $row->books_id;
			$booksList[$id]['books_id'] = $row->books_id;
			$booksList[$id]['books_name'] = $row->books_name;
			$booksList[$id]['books_picture'] = '/uploads/' . $row->books_picture;
			$booksList[$id]['books_description'] = $row->books_description;
			$booksList[$id]['books_date'] = $row->books_date;
			$booksList[$id]['authors'] = $row->authors;
			$booksList[$id]['genres'] = $row->genres;
		}
		$count_page = $this->db->query('SELECT Count(*) count_page FROM books')->row();
		$booksList['count_page'] = ceil((int)$count_page->count_page / NUM_BOOKS);

		return $booksList;
	}

	public function editBook($id, $data)
	{
		$data_update = array(
			'books_name' => $data['name'],
			'books_picture' => $data['picture'],
			'books_description' => $data['description'],
			'books_date' => $data['date']
		);
		$this->db->where('books_id', $id);
		$this->db->update('books', $data_update);

		$this->db->delete('books_authors', array('book_id' => $id));
		$this->db->delete('books_genres', array('book_id' => $id));

		foreach ($data['authors'] as $author) {
			$mas_authors[] = array(
				'book_id' => $id,
				'author_id' => (int)$author
			);
		}
		if (!$this->db->insert_batch('books_authors', $mas_authors)) return false;

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
