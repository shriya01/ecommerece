<div class="container">
	<?php 
	$i=0;
	foreach ($product_info as $key => $value) {
		if ($i<=count($product_info)) {
			?>
			<!-- Single Product -->
			<div class="col-12 col-sm-6 col-lg-4">
				<!-- Product Image -->
				<img style="width:200px; height:200px;" src="<?php echo $product_info[$i]['product_image']? base_url('uploads/').$product_info[$i]['product_image']:base_url('assets/frontend/images/no-image.png'); ?>" alt="" />

				<!-- Product Description -->
				<div class="product-description">
					<a >
						<h6><?php echo $product_info[$i]['product_name']; ?></h6>
					</a>
					<p class="product-price"><span style="text-decoration: line-through;">&#x20B9; <?php echo $product_info[$i]['product_price']; ?></span>&#x20B9; <?php echo $product_info[$i]['product_selling_price']; ?></p>
					
					
					<a href="<?php echo base_url('paymentMethod/add'); ?>"><button class="btn btn-default">Add to cart</button></a>
					
				</div>
			</div>
			<?php
		}
		$i++;
	} ?>
</div>

