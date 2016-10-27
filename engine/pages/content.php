<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
include 'engine/class/products.php';
$prod = new Products;

	$allProd = $prod->getAll();
	echo '<table class="table table-responsive table-condensed table-hover">';
	foreach ($allProd as $prod) 
	{
		$tcolor = ($prod['count']<=10)?'warning':'';
		echo  '<tr class="'.$tcolor.'"><td>'.$prod['id'].'</td><td>'.$prod['name'].'</td><td>'.$prod['descr'].'</td><td>'.$prod['count'].'</td><td>'.$prod['price'].'</td><td>'.$prod['wholeprice'].'</td></tr>';
	}
	echo '</table>';

// $id = $prod->addProduct('AddedFromClass','Prod From Class method','555555','5.55','2,55');
// var_dump($id);
// var_dump($prod->getOne($id));
// var_dump($prod->updateProduct('3', array('category'=>'1', 'name'=>'update���Tst','descr'=>'assssadadadadsd','count'=>'123456','price'=>'1516516005125100.515151', 'wholeprice'=>'1009952')));
// var_dump($prod->getOne('3'));
// var_dump($prod->getAll());
?>