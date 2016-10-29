<?php 
ini_set("display_errors",1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['access']) || $_SESSION['access']!=true && $_COOKIE["login"]!="true")
{
	$errors['msg'] = 'Не введен логин или пароль! <br> ('.date('d.m.Y H:i:s').') <br>';
	$_SESSION['errors'] = $errors;
	header("Location: login.php");
}
// include 'template/edit.tpl';

include 'engine/class/products.php';
$all_products_tpl ='';
$products = new Products;

	$allProd = $products->getAll();
	$all_products_tpl .= '<table id="allProducts" class="table table-responsive table-condensed table-hover">';
	$all_products_tpl .= '<tr class="success"><td>ID</td><td>Name</td><td>Description</td><td>Count</td><td>Price</td><td>Wholeprice</td><td>Actions</td></tr>';
	
	foreach ($allProd as $prod) 
	{
		$actions['edit'] = '<button class="btn btn-default" id="'.$prod['id'].'" onClick="edit('.$prod['id'].')" data-toggle="modal" data-target="#myModal">Edit</button>';
		$tcolor = ($prod['count']<=10)?'warning':'';
		$all_products_tpl .=  '<tr class="'.$tcolor.'"><td>'.$prod['id'].'</td><td id="name'.$prod['id'].'">'.$prod['name'].'</td><td id="descr'.$prod['id'].'">'.$prod['descr'].'</td><td id="count'.$prod['id'].'">'.$prod['count'].'</td><td id="price'.$prod['id'].'">'.$prod['price'].'</td><td id="wholeprice'.$prod['id'].'">'.$prod['wholeprice'].'</td><td>'.$actions['edit'].'</td></tr>';
	}
	$all_products_tpl .= '</table>';
	
	include 'template/main.tpl';
?>