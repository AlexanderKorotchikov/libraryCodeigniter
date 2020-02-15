<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Validator
{
	public function indexValid($data)
	{
		foreach ($data as $key => $dat) {
			if (!$this->validatorData($dat, $key)) {
				return false;
			}
		}
		return true;
	}

	public function validatorData($data, $key)
	{
		if ($key == 'authors' || $key == 'genres') {
			return true; // так как там массив и они уже проверялись
		} elseif ($key == 'date') {
			if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data)) {
				return false;
			}
		} else {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			if ($data == '') return false;
		}
		return true;
	}
}
