<?php require_once(getcwd() . '\application\views\header.php'); ?>

<div class="book">
	<span style="color:red;"><?php if (isset($_SESSION['error_edit'])) echo $_SESSION['error_edit']; ?></span>
	<form enctype="multipart/form-data" action="" method="post">
		<span>Имя</span>
		<input type="text" value="<?= $bookList['books_name'] ?>" name="name" required><br>
		<span>Картинка</span>
		<img src="<?= $bookList['books_picture'] ?>" alt="q"><br>
		<input type="hidden" value="<?= $bookList['books_picture'] ?>" name="picture_old">
		<input type="file" name="picture" id=""><br>
		<span>Дата издания:</span>
		<input type="date" value="<?= $bookList['books_date'] ?>" name="date" required><br>
		<span>Описание</span>
		<textarea name="description" id="" cols="30" rows="10" required><?= $bookList['books_description'] ?></textarea><br>
		<span>Автор(ы):</span>
		<select name="authors[ ]" multiple required>
			<?php foreach ($authors as $aut) { ?>
				<?php
				$author_id = explode(',', $bookList['authors_id']);
				foreach ($author_id as $a_id) {
					if ($aut['author_id'] == $a_id) {
						?>
						<option value="<?= $aut['author_id'] ?>"
								selected><?= $aut['author_name'] ?> <?= $aut['author_surname'] ?></option>
						<?php
						$noAuthor = 1;
						break;
					} else {
						$noAuthor = 0;
					}
				}
				if ($noAuthor == 0) {
					?>
					<option
						value="<?= $aut['author_id'] ?>"><?= $aut['author_name'] ?> <?= $aut['author_surname'] ?></option>
				<?php }
			} ?>
		</select>
		<br>
		<span>Жанры:</span>
		<select name="genres[ ]" multiple required>
			<?php foreach ($genres as $genre) { ?>
				<?php
				$genres_id = explode(',', $bookList['genres_id']);
				foreach ($genres_id as $genre_id) {
					if ($genre_id == $genre['genre_id']) {
						?>
						<option value="<?= $genre['genre_id'] ?>" selected><?= $genre['genre'] ?></option>
						<?php
						$noGenre = 1;
						break;
					} else {
						$noGenre = 0;
					}
				}
				if ($noGenre == 0) {
					?>
					<option value="<?= $genre['genre_id'] ?>"><?= $genre['genre'] ?></option>
				<?php }
			} ?>
		</select>
		<input type="submit" name="edit" value="Go">
	</form>

	<?php require_once(getcwd() . '\application\views\footer.php'); ?>
