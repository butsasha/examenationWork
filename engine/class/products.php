<?php 
class Products {
	private $username = 'but';
	private $password = '3105044';
	private $host	  = '94.244.128.42';
	private $base	  = 'cw';
	public $db;
	
	function __construct($db) {
		$this->db = $db;
	}
	
	public function getOne($id) {
					$this->db->where('id', $id);
		$products = $this->db->getOne('products', NULL, '*');
		return $products;
	}
	
	public function getAll() {
					$this->db->orderBy("products.id","desc");
		$products = $this->db->get('products', 20, '*');
		return $products;
	}
	
	public function addProduct($name, $descr, $category,$count, $price, $wholeprice) {
		$data = array("date" => date("Y-m-d H:i:s"),
					"name"  => $name,
					"descr" => $descr,
					"category" => $category,
					"count" => (int)$count,
					"price" => str_replace(',','.',$price),
					"wholeprice" => str_replace(',','.',$wholeprice)
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