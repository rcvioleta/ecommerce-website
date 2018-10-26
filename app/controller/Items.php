<?php  
class Items extends Controller {
	# set data var to private to avoid over-writing data variable from outside
	private $data = [
		'nameOfItem' => '',
		'itemPrice' => '',
		'itemQty' => '',
		'itemImage' => '',
		'nameOfItemErr' => '',
		'itemPriceErr' => '',
		'itemQtyErr' => '',
		'itemImageErr' => ''
	];	

	public function __construct() {
		# database queries from model/Item.php
		$this->itemModel = $this->model('item'); 
	}

	public function index() {
		# redirect user to the page where they can add products/items
		$this->view('products/add_item', $this->data);
	}

	public function add() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			# sanitize all coming inputs from post request
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			# initiate data array
			$data = [
				# data coming from post request
				'nameOfItem' => trim($_POST['name_of_item']),
				'itemPrice' => trim($_POST['item_price']),
				'itemQty' => trim($_POST['item_quantity']),
				'itemImage' => trim($_FILES['item_image']['name']),
				'tempItemImage' => trim($_FILES['item_image']['tmp_name']),
				'itemImageSize' => trim($_FILES['item_image']['size']),

				# Error section
				'nameOfItemErr' => '',
				'itemPriceErr' => '',
				'itemQtyErr' => '',
				'itemImageErr' => ''
			];	

			# set directory of the images to be save
			$imageDir = $_SERVER['DOCUMENT_ROOT'] . '/spurzt/public/images/product_images/'; 
			$data['targetFile'] = $imageDir . basename($data['itemImage']);

			# check if user provided name for the item/product
			if (empty($data['nameOfItem'])) {
				$data['nameOfItemErr'] = 'Name of item is required';
			}

			# check if the price is not empty
			if (empty($data['itemPrice'])) {
				$data['itemPriceErr'] = 'You need to specify the price';
			}
			elseif (!is_numeric($data['itemPrice'])) {
				$data['itemPriceErr'] = 'Price should only be a number';
			}

			# check if the quantity of the product isn't empty
			if (empty($data['itemQty'])) {
				$data['itemQtyErr'] = 'You need to add quantity to your item';
			}
			elseif (!is_numeric($data['itemQty'])) {
				$data['itemQtyErr'] = 'Quantity should only be a number';
			}

			# check if there is an image
			if (empty($data['itemImage'])) {
				$data['itemImageErr'] = 'Yay! You need to select an image before adding the item';
			}					

			if ($data['itemImageSize'] <= 0) {
				$data['itemImageErr'] = 'File not valid. Please select another image.';
			}
			elseif ($data['itemImageSize'] > 3097152) {
				$data['itemImageErr'] = 'File is too large. Max image file size should only be 3mb.';
			}

			# check if the file already exist 
			if (file_exists($data['targetFile'])) {
				$data['itemImageErr'] = 'Image already exist, choose another one.';
			}

			# checking if there are remaining errors 
			# if no more errors add new item/product
			if (empty($data['nameOfItemErr']) && empty($data['itemPriceErr']) && 
				empty($data['itemQtyErr']) && empty($data['itemImageErr'])) {
				# everything is good
				if ($this->itemModel->addNewItem($data)) {
					move_uploaded_file($data['tempItemImage'], $data['targetFile']);
					flash('new_item_added', 'New item added');
					redirect('items');
				}
			}
			# if there are still remaining errors, redirect user to the same page with errors
			else {
				$this->view('products/add_item', $data);
			}
		}
		else {
			$this->view('products/add_item', $this->data);
		}
	}
}
?>
