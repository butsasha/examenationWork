<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
include './../class/products.php';
$products = new Products;
// var_dump($_REQUEST);
	if (isset($_REQUEST['edit'])) {
		$productData = constructForm($products->getOne($_REQUEST['id']));
		echo $productData;
	} elseif (isset($_REQUEST['change'])) {
		$id = $_REQUEST['change'];
		$data = array('name'=>$_REQUEST['name'],'descr'=>$_REQUEST['descr'],
					'count'=>$_REQUEST['count'],'price'=>$_REQUEST['price'],
					'wholeprice'=>$_REQUEST['wholeprice']);
		if ($products->updateProduct($id,$data)) {
					echo json_encode(array("status"=>'success', "id"=>$id, "data"=>$data));
				} else {
					echo json_encode(array("status" => 'error'));
				}
		
	} elseif (isset($_REQUEST['add'])) {
		$id = $products->addProduct($_REQUEST['name'],$_REQUEST['descr'],$_REQUEST['count'],$_REQUEST['price'],$_REQUEST['wholeprice']);
		if ($id != 0) {
			$result = array("status"=>'success', "id"=>$id, "data"=>$products->getOne($id));
		} else {
			$result = array("status"=>'failed');
		}
		echo json_encode($result);
	}

function constructForm($data) {
	$returnData = '<form id="form'.$data['id'].'" class="form-horizontal">';
		$returnData .= '
		<div class="form-group">
			<label for="name'.$data['id'].'" class="col-sm-2 control-label">Name</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="name'.$data['id'].'" value="'.$data['name'].'">
			</div>
		</div>
		<div class="form-group">
			<label for="descr'.$data['id'].'" class="col-sm-2 control-label">Descr</label>
			<div class="col-sm-10">
			<textarea type="text" class="form-control" id="descr'.$data['id'].'">'.$data['descr'].'</textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="count'.$data['id'].'" class="col-sm-2 control-label">Count</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="count'.$data['id'].'" value="'.$data['count'].'">
			</div>
		</div>
		<div class="form-group">
			<label for="price'.$data['id'].'" class="col-sm-2 control-label">Price</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="price'.$data['id'].'" value="'.$data['price'].'">
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
	
// $id = $prod->addProduct('AddedFromClass','Prod From Class method','555555','5.55','2,55');
// var_dump($id);
// var_dump($prod->getOne($id));
// var_dump($prod->updateProduct('3', array('category'=>'1', 'name'=>'updateûûûTst','descr'=>'assssadadadadsd','count'=>'123456','price'=>'1516516005125100.515151', 'wholeprice'=>'1009952')));
// var_dump($prod->getOne('3'));
// var_dump($prod->getAll());
?>