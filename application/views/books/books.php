<?php require_once(getcwd() . '\application\views\header.php'); ?>

<?php foreach ($booksList as $book) { ?>
	<div id="book-<?= $book['books_id'] ?>" class="book">
		<p><?= $book['books_name'] ?></p>
		<a href="/index.php/books/<?= $book['books_id'] ?>"><img src="<?= $book['books_picture'] ?>" alt="q"></a>
		<p><?= mb_strimwidth($book['books_description'], 0, 300, "..."); ?></p>
		Дата издания: <span><?= $book['books_date'] ?></span><br>
		Автор(ы): <?= $book['authors'] ?>
		<hr>
		Жанр(ы): <?= $book['genres'] ?>
		<br>
		<hr>
		<a href="/index.php/books/<?= $book['books_id'] ?>">читать</a>
	</div>
<?php } ?>

<nav class="text-center">
	<ul class="pagination">
		<?php for ($i = 1; $i <= $count_page; $i++) { ?>
			<li><a href="/books/page/<?= $i ?>"><?= $i ?></a></li>
		<?php } ?>
	</ul>
</nav>

<?php require_once(getcwd() . '\application\views\footer.php'); ?>




