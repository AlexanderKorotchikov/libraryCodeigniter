<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UploadFile
{
	public function do_upload($file)
	{
		$uploaddir = getcwd() . '/uploads/';
		$uploadfile = $uploaddir . basename($file['picture']['name']);

		if (!move_uploaded_file($file['picture']['tmp_name'], $uploadfile)) {
			return false;
		}
		return true;
	}
}
