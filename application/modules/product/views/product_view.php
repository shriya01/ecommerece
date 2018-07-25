<!DOCTYPE html>
<html lang="en">
<head>
 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title>ci ecommerce</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
<div class="container">
<h2></h2>	
	<div class="row">
		
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" id="register-form" action="<?php echo base_url()."index.php/product/InsertProduct"?>" method="post" name="signupform">
				<fieldset>
					<legend>INSERT PRODUCT</legend>

					<div class="form-group">
						<div id="error">
						<?php 
				echo validation_errors(); 
				
				if(isset($errorMsg))
				{
					echo '<div class="error-msg">';
					echo $errorMsg;
					echo '</div>';
					unset($errorMsg);
				}
			?>	
					</div>
						<label for="name">product name</label>
						<input type="text" class="form-control"  id="product_name" name="product_name" value="<?php echo set_value('product_name'); ?>"   />
						<span id="product_name" class="text-danger">
						
						</span>
					</div>		

					<div class="form-group">
					
						<label for="name">product description</label>
						
						<textarea class="form-control"  id="product_description" name="product_description	" value="<?php echo set_value('product_description'); ?>" ></textarea>
						<span id="product_description	" class="text-danger">
						
						</span>
					</div>	
					<div class="form-group">
					
						<label for="name">product price</label>
						<input type="text" class="form-control" id="product_price" name="product_price" value="<?php echo set_value('product_price'); ?>"   />
						<span id="product_price" class="text-danger">
						
						</span>
					</div>			
					
					<div class="form-group">
						<label for="name">product discount</label>
						<input type="text" class="form-control" id="product_discount" name="product_discount" value="<?php echo set_value('product_discount'); ?>"  />
						
						<span id="product_discount" class="text-danger">
						
						</span>
					</div>
					<div class="form-group">
						<label for="name">prodect selling price</label>
						<input type="text" class="form-control" id="prodect_selling_price" name="prodect_selling_price" value="<?php echo set_value('prodect_selling_price'); ?>"   />
						<span id="prodect_selling_price" class="text-danger">
						
						</span>
					</div>
					<div class="form-group">
					 <label>
        <span>category name</span>
        <select name="category_name">
        <option value="Black">Black</option>
        <option value="Silver">Silver</option>
        </select>
    </label>
			</div>		
					
					<div class="form-group">
						<input type="submit" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			
		</div>
	</div>
	
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
  </body>
  
  </html>


