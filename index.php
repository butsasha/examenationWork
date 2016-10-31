<?php 
ini_set("display_errors",1);
error_reporting(E_ALL);
include 'engine/config.php';
include 'engine/class/products.php';
include 'engine/class/categories.php';

session_start();
if(!isset($_SESSION['access']) || $_SESSION['access']!=true && $_COOKIE["login"]!=true)
{
	$errors['msg'] = 'Не введен логин или пароль! <br> ('.date('d.m.Y H:i:s').') <br>';
	$_SESSION['errors'] = $errors;
	header("Location: login.php");
}

$categories = new Categories($db);
$listOfCategories = $categories->getList();
// var_dump($listOfCategories);

$all_products_tpl ='';
$products = new Products($db);

	$allProd = $products->getAll();
	$all_products_tpl .= '<table id="allProducts" class="table table-responsive table-condensed table-hover sortable">';
	$all_products_tpl .= '<trclass="success"><th>ID</th><th>Name</th><th>Description</th><th>Category</th><th>Count</th><th>Price</th><th>Wholeprice</th><th>Actions</th></tr>';
	
	foreach ($allProd as $prod) 
	{
		$actions['edit'] = '<button class="btn btn-default btn-md" id="'.$prod['id'].'" onClick="edit('.$prod['id'].')" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
			<button type="button" class="btn btn-danger btn-md" onClick="remove('.$prod['id'].',0)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
		$tcolor = ($prod['count']<=10)?'warning':'';
		$all_products_tpl .=  '<tr class="'.$tcolor.'" id="row'.$prod['id'].'"><td>'.$prod['id'].'</td><td id="name'.$prod['id'].'">'.$prod['name'].'</td><td id="descr'.$prod['id'].'">'.$prod['descr'].'</td><td id="category'.$categories->getName($prod['category']).'">'.$categories->getName($prod['category']).'</td><td id="count'.$prod['id'].'">'.$prod['count'].'</td><td id="price'.$prod['id'].'">'.$prod['price'].'</td><td id="wholeprice'.$prod['id'].'">'.$prod['wholeprice'].'</td><td>'.$actions['edit'].'</td></tr>';
	}
	$all_products_tpl .= '</table>';
	
	include 'template/main.tpl';
?>