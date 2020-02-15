<?php require_once(getcwd() . '\application\views\header.php'); ?>

<div class="book">
	<p><?= $bookList['books_name'] ?></p>
	<img src="<?= $bookList['books_picture'] ?>" alt="q">
	<p><?= $bookList['books_description'] ?></p>
	Дата издания:<span><?= $bookList['books_date'] ?></span><br>
	Автор(ы): <?= $bookList['authors'] ?>
	<hr>
	Жанр(ы): <?= $bookList['genres'] ?><br>
	<button class="back" onclick="window.history.back()">Назад</button>
	<a class="edit" href="/books/edit/<?= $bookList['books_id'] ?>">Редактироваь</a>
</div>

<?php require_once(getcwd() . '\application\views\footer.php'); ?>

