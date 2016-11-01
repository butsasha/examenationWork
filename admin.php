<?php 
ini_set("display_errors",1);
error_reporting(E_ALL);
include 'engine/config.php';
include 'engine/class/admins.php';

session_start();
if(!isset($_SESSION['access']) || $_SESSION['access']!=true && $_COOKIE["login"]!=true)
{
	$errors['msg'] = 'Не введен логин или пароль! <br> ('.date('d.m.Y H:i:s').') <br>';
	$_SESSION['errors'] = $errors;
	header("Location: login.php");
}

$all_admins_tpl ='';
$admin = new Admins($db);

	$allAdmin = $admin->getAll();
	$all_admins_tpl .= '<table id="allAdmins" class="table table-responsive table-condensed table-hover sortable">';
	$all_admins_tpl .= '<trclass="success"><th>ID</th><th>Login</th><th>E-mail</th><th>Actions</th></tr>';
	
	foreach ($allAdmin as $admin) 
	{
		$actions['edit'] = '<button class="btn btn-default btn-md" id="'.$admin['id'].'" onClick="edit('.$admin['id'].')" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
			<button type="button" class="btn btn-danger btn-md" onClick="remove('.$admin['id'].',0)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
		$all_admins_tpl .=  '<tr id="row'.$admin['id'].'"><td>'.$admin['id'].'</td><td id="login'.$admin['id'].'">'.$admin['login'].'</td><td id="email'.$admin['id'].'">'.$admin['email'].'</td><td>'.$actions['edit'].'</td></tr>';
	}
	$all_admins_tpl .= '</table>';
	
	include 'template/admins.tpl';
?>