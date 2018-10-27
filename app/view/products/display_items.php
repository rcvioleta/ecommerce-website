<?php include_once APP_ROOT . '/view/includes/header.php'; ?>
<?php include_once APP_ROOT . '/view/includes/nav_bar.php'; ?>

<div class="container">
	<div class="flexbox">
		<?php foreach ($data['products'] as $product): ?>
			<div class="flexbox-item">
				<div class="card card-body">
					<h4 class="card-title"><?php echo $product->item_name; ?></h4>
					<div class="card-text">
						<div>Price: $<?php echo $product->item_price; ?></div>
						<div>Quantity: <?php echo $product->item_quantity; ?></div>
						<div>Created at: <?php echo $product->date_created; ?></div>
						<div><img class="image_preview" src="<?php echo URL_ROOT . $product->image_path; ?>"></div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>			
</div>

<?php include_once APP_ROOT . '/view/includes/footer.php'; ?>
