<?php require_once('header.php'); ?>

<div class="forms">
	<div id="primary">
		<input type="button" name="as" value="Добавить автора" checked=""/>
		<input type="button" name="as" value="Добавить жанр"/>
		<input type="button" name="as" value="Добавить книгу"/>
	</div>
	<span style="color:red;"><?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?></span>
	<div id="secondary">
		<div class="form">
			Добавить автора<br><br>
			<form enctype="multipart/form-data" action="" method="post">
				<span>Имя</span><input type="text" required name="name" id=""><br>
				<span>Фамилия</span><input type="text" required name="surname" id=""><br>
				<span>Отчество</span><input type="text" required name="patronymic" id=""><br>
				<span>Дата</span><input type="date" required name="date" id=""><br>
				<input type="submit" value="Go" name="add_author">
			</form>
		</div>
		<div class="form">
			Добавить жанр <br><br>
			<form enctype="multipart/form-data" action="" method="post">
				<span>Жанр</span><input type="text" name="genre" id="" required><br>
				<input type="submit" value="Go" name="add_genre">
			</form>
		</div>
		<div class="form" style="display:block">
			Добавить книгу<br><br>
			<form enctype="multipart/form-data" action="" method="post">
				<span>Название</span> <input type="text" required name="name" id=""><br>
				<span>Картинка</span> <input type="file" required name="picture" id=""><br>
				<span>Описание</span> <textarea name="description" required id="" cols="30" rows="5"></textarea><br>
				<span>Дата, год выпуска</span> <input type="date" required name="date" id=""><br>
				<span>Авторы</span> <select name="authors[ ]" multiple required>
					<?php foreach ($authors as $author) { ?>
						<option
							value="<?= $author['author_id'] ?>"><?= $author['author_name'] ?> <?= $author['author_surname'] ?></option>
					<?php } ?>
				</select><br>
				<span>Жанры</span> <select name="genres[ ]" multiple required>
					<?php foreach ($genres as $genre) { ?>
						<option value="<?= $genre['genre_id'] ?>"><?= $genre['genre'] ?></option>
					<?php } ?>
				</select><br>
				<input type="submit" value="Go" name="add_book">
			</form>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>
