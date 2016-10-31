<?php 
class Categories {
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
		$categories = $this->db->getOne('categories', NULL, '*');
		return $categories;
	}
	
	public function getName($id) 
	{
					$this->db->where('id', $id);
		$catName =  $this->db->getOne('categories', NULL, 'category');
		$catName = ($catName == NULL)?'Unknown':$catName['category'];

		return $catName;
	}
	
	public function getList() {
		$list ='';
		foreach ($this->getAll() as $cat) {
			$list .= '<option value="'.$cat['id'].'">'.$cat['category'].'</option>'."\n";
		}
		return $list;
	}
	
	public function getAll() {
					$this->db->orderBy("categories.id","desc");
		$categories = $this->db->get('categories', NULL, '*');

		return $categories;
	}
	
	public function addCategory($name) {
		$data = array("name"  => $name,);

		$id = $this->db->insert ('categories', $data);
		return $id;
	}
	
	public function updateCategory($id, $params) {
					$this->db->where ('id', $id);
		$result = ($this->db->update('categories', $params)) ? 1 : 0;
		return $result;
	}
	
	public function removeCategory($id) {
		$this->db->where('id', $id);
		$result = ($this->db->delete('categories')) ? 1 : 0;
		return $result;
	}
}
?>