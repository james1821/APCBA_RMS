<?php 
	require 'validation.php';
require 'functions.php';

if(!empty($_POST['data_type']))
{
	$info['data_type'] 	= $_POST['data_type'];
	$info['errors'] 	= [];
	$info['success'] 	= false;
	

	if($_POST['data_type'] == "student-add")
	{

		require 'includes/student-add.php';
	}else
	if($_POST['data_type'] == "profile-edit")
	{

		$id = $_POST['id'];

		$row = db_query("select * from student where id = :id limit 1",['id'=>$id]);
		if($row)
		{
			$row = $row[0];
		}
		require 'includes/profile-edit.php';
	}else
	if($_POST['data_type'] == "profile-delete")
	{

		$id = user('id');

		$row = db_query("select * from users where id = :id limit 1",['id'=>$id]);
		if($row)
		{
			$row = $row[0];
		}
		require 'includes/profile-delete.php';
	}else
	if($_POST['data_type'] == "login")
	{

		require 'includes/login.php';
	}

	echo json_encode($info);
}

