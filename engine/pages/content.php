<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
include './../class/products.php';
$products = new Products;
var_dump($_REQUEST);
	if (isset($_REQUEST['edit'])) {
		// var_dump($products->getOne(json_decode($_REQUEST['id'])['id']));
	}

// $id = $prod->addProduct('AddedFromClass','Prod From Class method','555555','5.55','2,55');
// var_dump($id);
// var_dump($prod->getOne($id));
// var_dump($prod->updateProduct('3', array('category'=>'1', 'name'=>'updateûûûTst','descr'=>'assssadadadadsd','count'=>'123456','price'=>'1516516005125100.515151', 'wholeprice'=>'1009952')));
// var_dump($prod->getOne('3'));
// var_dump($prod->getAll());
?>