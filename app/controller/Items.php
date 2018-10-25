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

	public function add_new_item() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			# sanitize all coming inputs from post request
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			# initiate data array
			$data = [
				# data coming from post request
				'nameOfItem' => trim($_POST['name_of_item']),
				'itemPrice' => trim($_POST['item_price']),
				'itemQty' => trim($_POST['item_quantity']),
				'itemImage' => trim($_POST['item_image']),

				# Error section
				'nameOfItemErr' => '',
				'itemPriceErr' => '',
				'itemQtyErr' => '',
				'itemImageErr' => ''
			];	

			# set directory of the images to be save
			$photoDirectory = URL_ROOT . '/public/images/product_images/'; 

			# check if user provided name for the item/product
			if (empty($data['nameOfItem'])) {
				$data['nameOfItemErr'] = 'Name of item is required';
			}

			# check if the price is not empty
			if (empty($data['itemPrice'])) {
				$data['itemPriceErr'] = 'You need to specify the price';
			}

			# check if the quantity of the product isn't empty
			if (empty($data['itemQty'])) {
				$data['itemQtyErr'] = 'You need to add quantity to your item';
			}

			# check if there is an image
			if (empty($data['itemImage'])) {
				$data['itemImageErr'] = 'Yay! You need to select an image before adding the item';
			}						

			# checking if there are remaining errors 
			# if no more errors add new item/product
			if (empty($data['nameOfItemErr']) && empty($data['itemPriceErr']) && 
				empty($data['itemQtyErr']) && empty($data['itemImageErr'])) {
				# everything is good
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