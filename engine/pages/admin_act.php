<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
include './../config.php';
include './../class/admins.php';

$admins = new Admins($db);
// var_dump($_REQUEST);
	if (isset($_REQUEST['edit'])) {
		$adminsData = constructForm($admins->getOne($_REQUEST['id']));
		echo $adminsData;
	} elseif (isset($_REQUEST['change'])) {
		$id = $_REQUEST['change'];
		$data = array('login'=>$_REQUEST['login'],'password'=>md5($_REQUEST['password']),'email'=>$_REQUEST['email'],);
		if ($admins->updateAdmin($id,$data)) {
					echo json_encode(array("status"=>'success', "id"=>$id, "data"=>$data));
				} else {
					echo json_encode(array("status" => 'failed'));
				}
	} elseif (isset($_REQUEST['add'])) {
		// var_dump($_REQUEST);
		$allAdmins =  $admins->getAll();
		
		foreach ($allAdmins as $admin) {
			if ($_REQUEST['login'] == $admin['login']) {
				echo json_encode(array('status' => 'failed', 'reason' => 'Admin exists!')); 
				die();
			}
		}
		
		$id = $admins->addAdmin($_REQUEST['login'],md5($_REQUEST['password']),$_REQUEST['email']);
		if ($id != 0) {
		$newAdmin = $admins->getOne($id);
		$data = '<tr id="row'.$newAdmin['id'].'"><td>'.$newAdmin['id'].'</td><td id="login'.$newAdmin['id'].'">'.$newAdmin['login'].'</td><td id="email'.$newAdmin['id'].'">'.$newAdmin['email'].'</td><td><button class="btn btn-default btn-md" id="'.$newAdmin['id'].'" onClick="edit('.$newAdmin['id'].')" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> <button type="button" class="btn btn-danger btn-md" onClick="remove('.$newAdmin['id'].',0)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
			$result = array("status"=>'success', "id"=>$id, "data"=>$data);
		} else {
			$result = array("status"=>'failed');
		}
		echo json_encode($result);
	} elseif (isset($_REQUEST['remove'])) {
		$id = $_REQUEST['remove'];
		$res = $admins->removeAdmin($id);
		if ($res != 0) {		
			$result = array("status"=>'success');
		} else {
			$result = array("status"=>'failed');
		}
		echo json_encode($result);
	}

function constructForm($data) {
	$returnData = '<form id="	form'.$data['id'].'" class="form-horizontal">';
		$returnData .= '
		<div class="form-group">
			<label for="login'.$data['id'].'" class="col-sm-2 control-label" >Login</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="login'.$data['id'].'" value="'.$data['login'].'" required>
			</div>
		</div>
		<div class="form-group">
			<label for="password'.$data['id'].'" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
			<input type="password" class="form-control" id="password'.$data['id'].'" required>
			</div>
		</div>
		<div class="form-group">
			<label for="email'.$data['id'].'" class="col-sm-2 control-label">E-mail</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="email'.$data['id'].'" value="'.$data['email'].'">
			</div>
		</div>
		';
	$returnData.='</form>';
	
return $returnData;
}
?>