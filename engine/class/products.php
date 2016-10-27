<?php 
include 'engine/config.php';
include 'engine/class/database.php';

class Products {
	
	private $db;
	
	function __construct() {
		$this->db = new Database(array(
                'host' => '94.244.128.42',
                'username' => 'but', 
                'password' => '3105044',
                'db'=> 'cw',
                'charset' => 'utf8'));
	}
	
	public function getOne($id) {
					$this->db->where('id', $id);
		$products = $this->db->getOne('products', NULL, '*');
		return $products;
	}
	
	public function getAll() {
		$products = $this->db->get('products', NULL, '*');
		return $products;
	}
	
	public function addProduct($name, $descr, $count, $price, $wholeprice) {
		$data = array("date" => date("Y-m-d H:i:s"),
					"name"  => $name,
					"descr" => $descr,
					"count" => $count,
					"price" => $price,
					"wholeprice" => $wholeprice
		);

		$id = $this->db->insert ('products', $data);
		return $id;
	}
	
	public function updateProduct($id, $params) {
		$this->db->where ('id', $id);
		$result = ($this->db->update('products', $params)) ? 1 : 0;
		return $result;
	}
	
	public function removeProduct($id) {
		$this->db->where('id', $id);
		$result = ($this->db->delete('products')) ? 1 : 0;
		return $result;
	}
}
?>