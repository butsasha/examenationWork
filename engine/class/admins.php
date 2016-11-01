<?php 
class Admins {
	public $db;
	
	function __construct($db) {
		$this->db = $db;
	}
	
	public function getOne($id) {
					$this->db->where('id', $id);
		$admins = $this->db->getOne('admins', NULL, '*');
		return $admins;
	}
	
	public function getAll() {
					$this->db->orderBy("admins.id","desc");
		$admins = $this->db->get('admins', 20, '*');
		return $admins;
	}
	
	public function addAdmin($login, $password, $email) {
		$data = array("login"  => $login,
					"password" => $password,
					"email" => $email
		);

		$id = $this->db->insert ('admins', $data);
		return $id;
	}
	
	public function updateAdmin($id, $params) {
		$this->db->where ('id', $id);
		$result = ($this->db->update('admins', $params)) ? 1 : 0;
		return $result;
	}
	
	public function removeAdmin($id) {
		$this->db->where('id', $id);
		$result = ($this->db->delete('admins')) ? 1 : 0;
		return $result;
	}
}
?>