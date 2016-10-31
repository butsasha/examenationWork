<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
include './../config.php';
include './../class/products.php';
include './../class/categories.php';

$categories = new Categories($db);
$listOfCategories = $categories->getAll();
// var_dump($listOfCategories);

$products = new Products($db);
// var_dump($_REQUEST);
	if (isset($_REQUEST['edit'])) {
		$productData = constructForm($products->getOne($_REQUEST['id']), $categories);
		echo $productData;
	} elseif (isset($_REQUEST['change'])) {
		$id = $_REQUEST['change'];
		$data = array('name'=>$_REQUEST['name'],'descr'=>$_REQUEST['descr'],'category'=>$_REQUEST['category'],
					'count'=>$_REQUEST['count'],'price'=>str_replace(',','.',$_REQUEST['price']),
					'wholeprice'=>str_replace(',','.',$_REQUEST['wholeprice']));
		if ($products->updateProduct($id,$data)) {
					echo json_encode(array("status"=>'success', "id"=>$id, "data"=>$data, 'category_name'=>$categories->getName($_REQUEST['category'])));
				} else {
					echo json_encode(array("status" => 'failed'));
				}
		
	} elseif (isset($_REQUEST['add'])) {
		var_dump($_REQUEST);
		$id = $products->addProduct($_REQUEST['name'],$_REQUEST['descr'],$_REQUEST['category'],$_REQUEST['count'],$_REQUEST['price'],$_REQUEST['wholeprice']);
		if ($id != 0) {
		$newProd = $products->getOne($id);			
		$data = '<tr id="row'.$newProd['id'].'"><td>'.$newProd['id'].'</td><td id="name'.$newProd['id'].'">'.$newProd['name'].'</td><td id="descr'.$newProd['id'].'">'.$newProd['descr'].'</td><td id="category'.$newProd['id'].'">'.$categories->getName($newProd['category']).'</td><td id="count'.$newProd['id'].'">'.$newProd['count'].'</td><td id="price'.$newProd['id'].'">'.$newProd['price'].'</td><td id="wholeprice'.$newProd['id'].'">'.$newProd['wholeprice'].'</td><td><button class="btn btn-default btn-md" id="'.$newProd['id'].'" onClick="edit('.$newProd['id'].')" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> <button type="button" class="btn btn-danger btn-md" onClick="remove('.$newProd['id'].',0)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
			$result = array("status"=>'success', "id"=>$id, "data"=>$data);
		} else {
			$result = array("status"=>'failed');
		}
		echo json_encode($result);
	} elseif (isset($_REQUEST['remove'])) {
		$id = $_REQUEST['remove'];
		$res = $products->removeProduct($id);
		if ($res != 0) {		
			$result = array("status"=>'success');
		} else {
			$result = array("status"=>'failed');
		}
		echo json_encode($result);
	}

function constructForm($data, $categories) {
	$returnData = '<form id="form'.$data['id'].'" class="form-horizontal">';
		$returnData .= '
		<div class="form-group">
			<label for="name'.$data['id'].'" class="col-sm-2 control-label" >Name</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="name'.$data['id'].'" value="'.$data['name'].'" required>
			</div>
		</div>
		<div class="form-group">
			<label for="descr'.$data['id'].'" class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
			<textarea type="text" class="form-control" id="descr'.$data['id'].'">'.$data['descr'].'</textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="cats" class="col-sm-2">Categories:</label>
				<div class="col-sm-10">
					<select class="form-control" id="category'.$data['id'].'">
						<option>---Select---</option>
						'.$categories->getList().'
					</select>
				</div>
			</div>
		<div class="form-group">
			<label for="count'.$data['id'].'" class="col-sm-2 control-label">Count</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="count'.$data['id'].'" value="'.$data['count'].'" required>
			</div>
		</div>
		<div class="form-group">
			<label for="price'.$data['id'].'" class="col-sm-2 control-label">Price</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="price'.$data['id'].'" value="'.$data['price'].'" required>
			</div>
		</div>
		<div class="form-group">
			<label for="Wholeprice'.$data['id'].'" class="col-sm-2 control-label">Wholeprice</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="wholeprice'.$data['id'].'" value="'.$data['wholeprice'].'">
			</div>
		</div>
		';
	$returnData.='</form>';
	
return $returnData;
}
?>