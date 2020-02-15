<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Library</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
		#secondary div {
			display: none;
		}

		#navbar {
			margin: 0;
			padding: 0;
			list-style-type: none;
		}

		#navbar li {
			display: inline;
		}

		#navbar {
			margin: 0;
			padding: 0;
			list-style-type: none;
			border: 2px solid #0066FF;
			border-radius: 20px 5px;
			width: 50%;
			margin-left: 25%;
			text-align: center;
			background-color: #33ADFF;
		}

		#navbar a {
			color: #fff;
			padding: 5px 10px;
			text-decoration: none;
			font-weight: bold;
			display: inline-block;
			width: 100px;
		}

		#navbar a:hover {
			border-radius: 20px 5px;
			background-color: #0066FF;
		}

		.book {
			width: 50%;
			margin-left: 25%;
			text-align: center;
			border: 2px solid #0066FF;
			border-radius: 20px 5px;
			background-color: #ffffff;
			margin-top: 1%;
			margin-bottom: 1%;
		}

		.book img {
			width: 50%;
		}

		.forms {
			width: 30%;
			margin-left: 35%;
			margin-top: 1%;
		}

		.form {
			padding: 5%;
		}

		input, textarea, select {
			border: 2px solid #0066FF;
			/* border-radius: 20px 5px; */
			background-color: #ffffff;
		}

		.back {
			margin: 1%;
		}

		.edit {
			margin-left: 70%;
		}
	</style>
</head>
<body>
<ul id="navbar">
	<li><a href="/">Главная</a></li>
	<li><a href="/index.php/books">Книги</a></li>
</ul>
