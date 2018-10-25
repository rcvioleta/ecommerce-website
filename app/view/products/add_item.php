<?php include_once APP_ROOT . '/view/includes/header.php'; ?>
<?php include_once APP_ROOT . '/view/includes/nav_bar.php'; ?>

<div class="container add_products">
	<form action="<?php echo URL_ROOT; ?>/items/add_new_item" method="POST">
	  	<div class="form-group">
	    	<label for="inputItemName">Name of Item</label>
	    	<input type="text" name="name_of_item" class="form-control <?php echo !empty($data['nameOfItemErr']) ? 'is-invalid' : ''; ?>" id="inputItemName" value="<?php echo $data['nameOfItem']; ?>">
	    	<span class="invalid-feedback"><?php echo $data['nameOfItemErr']; ?></span>
	  	</div>

	  	<div class="form-row">
	    	<div class="form-group col-md-6">
	      		<label for="inputItemPrice">Price</label>
	      		<input type="text" name="item_price" class="form-control <?php echo !empty($data['itemPriceErr']) ? 'is-invalid' : ''; ?>" id="inputItemPrice" value="<?php echo $data['itemPrice']; ?>">
	      		<span class="invalid-feedback"><?php echo $data['itemPriceErr']; ?></span>
	    	</div>
	    	<div class="form-group col-md-6">
	      		<label for="inputItemQuantity">Quantity</label>
	      		<input type="text" name="item_quantity" class="form-control <?php echo !empty($data['itemQtyErr']) ? 'is-invalid' : ''; ?>" id="inputItemQuantity" value="<?php echo $data['itemQty']; ?>">
	      		<span class="invalid-feedback"><?php echo $data['itemQtyErr']; ?></span>
	    	</div>
	  	</div>

  	  	<div class="form-group">
		    <label for="inputImage">Browse images</label>
		    <input type="file" name="item_image" class="form-control-file <?php echo !empty($data['itemImageErr']) ? 'is-invalid' : ''; ?>" id="inputImage">
		    <span class="invalid-feedback"><?php echo $data['itemImageErr']; ?></span>
	  	</div>

 		<button type="submit" class="btn btn-primary btn-small">Add Product</button>
	</form>
</div>

<?php include_once APP_ROOT . '/view/includes/footer.php'; ?>