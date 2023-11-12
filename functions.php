<?php

require 'validation.php';

function db_query(string $query, array $data = array())
{
	$string = "mysql:hostname=localhost;dbname=db_sfms";
	$con = new PDO($string, 'root', '');

	$stm = $con->prepare($query);
	$check = $stm->execute($data);

	if($check)
	{
		$res = $stm->fetchAll(PDO::FETCH_ASSOC);
		if(is_array($res) && !empty($res))
		{
			return $res;
		} 
	}

	return false;
}



function redirect($path):void
{
	header("Location: $path");
	die;
}

function esc(string $str):string
{
	return htmlspecialchars($str);
}

function user(string $key = '')
{
	
}


function get_image($path = ''):string 
{
	if(file_exists($path))
	{
		return $path;
	}

	return './images/no-image.jpg';
}
