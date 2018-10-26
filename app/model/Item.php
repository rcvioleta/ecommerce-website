<?php  
class Item {
	private $db;

	public function __construct() {
		$this->db = new Database;				
	}

	# look for any instance of the item that the user is trying to add in the system
	public function findItemById($id) {
		
	}

	# add new items/products to database
	public function addNewItem($data) {
		$this->db->query(
			'INSERT INTO items (item_name, item_price, item_quantity, image_path, date_created) 
			VALUES(:name, :price, :quantity, :image, :created)'
		);

		# Bind values
		$this->db->bind(':name', $data['nameOfItem']);
		$this->db->bind(':price', $data['itemPrice']);
		$this->db->bind(':quantity', $data['itemQty']);
		$this->db->bind(':image', $data['targetFile']);
		$this->db->bind(':created', date('Y-m-d H:i:s'));

		return $this->db->execute();
	}
}
?>
