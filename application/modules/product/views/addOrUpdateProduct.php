<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<?php echo validation_errors('<div class="text-center text-danger"> ', '</div>');?>
				<?php 
                if (isset($this->session->error)) {
                    echo "<div class='text-center text-danger'>".$this->session->error."</div>";
                }
                ?>
				<?php if ($product_id != '') {
                    ?>
					<h2>Update Account Details</small></h2>
					<?php
                } else {
                    ?>
					<h2>Add New product</small></h2>
					<?php
                } ?>
				<hr class="colorgraph">
				<?php 	$attributes = array('class' => 'register-form', 'id' => 'adduser','role' => 'form');
                echo form_open('', $attributes); ?>
				<?php  foreach ($product_info as $key) {
                    $productname = 	$key['product_name'];
                    $productdescription =    $key['product_description'];
                    $productprice = 	$key['product_price'];
                    $productdiscount = 	$key['product_discount'];
                    $prodectsellingprice = $key['prodect_selling_price'];
                }
                ?>
				<!-- Name Field -->
				<div class="form-group">
					<?php 
                    $productname = array(
                        'name'          => 'product_name',
                        'id'            => 'product_name',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'Product Name',
                        'tabindex' 		=> '3',
                        'value'			=> isset($productname) ? $productname : $this->input->post('product_name')
                        );
                    echo form_input($productname);
                    ?>
				</div>
                    <!-- Name Field -->
                <div class="form-group">
                    <?php 
                    $productdescription = array(
                        'name'          => 'productdescription',
                        'id'            => 'product_description',
                        'class'         => 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder'   => 'Product Description',
                        'tabindex'      => '3',
                        'value'         => isset($productdescription) ? $productdescription : $this->input->post('product_description')
                        );
                    echo form_input($productdescription);
                    ?>
                </div>
				<!-- Email Field -->
				<div class="form-group">
					<?php 
                    $productprice = array(
                        'name'          => 'product_price',
                        'id'            => 'product_price',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'Product Price',
                        'tabindex' 		=> '3',
                        'value'			=> isset($productprice) ? $productprice : $this->input->post('product_price'),
                        );
                    echo form_input($productprice);
                    ?>
				</div>
				<?php if ($product_id == ''):
                ?>
				<!-- Password Field -->
				<div class="form-group">
					<?php 
                    $productdiscount = array(
                        'name'          => 'product_discount',
                        'id'            => 'product_discount',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'product discount',
                      
                        'tabindex' 		=> '3',
                        );
                    echo form_input($productdiscount);
                    ?>
				</div>
				
			<?php endif; ?>
			<!-- Mobile Number Field -->
			<div class="form-group">
				<?php 
                $prodectsellingprice = array(
                    'name'          => 'prodect_selling_price',
                    'id'            => 'prodect_selling_price',
                    'class'			=> 'form-control input-lg',
                    'maxlength'     => '100',
                    'placeholder' 	=> 'prodect selling price',
                    'tabindex' 		=> '3',
                    'value'			=> isset($prodectsellingprice) ? $prodectsellingprice : $this->input->post('prodect_selling_price')
                    );
                echo form_input($prodectsellingprice);
                ?>
			</div>
			<div class="form-group">
				<?php
				$options = array(
        'small'         => 'Small Shirt',
        'med'           => 'Medium Shirt',
        'large'         => 'Large Shirt',
        'xlarge'        => 'Extra Large Shirt',
);
				$js = array(
        'id'       => 'shirts',
        'onChange' => 'some_function();'
);

$shirts_on_sale = array('small','med', 'xlarge' , 'large');
echo form_dropdown('shirts', $options, $shirts_on_sale, $js );
?>
			</div>


    <?php echo form_open_multipart('upload/do_upload');?>

<input type="file" value="product image" name="userfile" size="20" />


<input type="submit" value="upload" />
       
			<hr>
			<div class="row">
				<div class="col-xs-12 col-md-3">
					<?php 
                    echo form_submit('updateUser', 'SAVE', array('class'=>'btn btn-primary btn-lg','tabindex'=>'7'));
                    ?>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
</section>