<!DOCTYPE html>
<html lang="en">
 <head>
  <title>Display Records From Database Using Codeigniter</title>
  <link href="<?= base_url();?>css/bootstrap.css" rel="stylesheet">
 </head>
 <body>
  <div class="row">
   <div style="width:500px;margin:50px;">
    <h4>Display Records of Existing product </h4>
    <table class="table table-striped table-bordered">
     <tr>
      <td><strong>Product Id</strong></td>
      <td><strong>Product Name</strong></td>
      <td><strong>product description</strong></td>
      <td><strong>product price</strong></td>
      <td><strong>product discount</strong></td>
      <td><strong>category name</strong></td>
      <td><strong>Action</strong></td>

    </tr> 
     <?php 
	
	 foreach ($all_data as $row)  
	 {?>
     <tr> <td><?php echo $row['product_id'];?></td>
      <td><?php echo $row['product_name'];?></td>
      <td><?php echo  $row['product_description'];?></td>
      <td><?php echo $row['product_price'];?></td>
      <td><?php echo $row['product_discount'];?></td>
      <td><?php echo $row['category_name'];?></td>

    
      <td>
 <a href="<?php echo base_url('index.php/product/edit/'.$row['product_id']); ?>">Edit</a> | 
  <a href="<?php echo base_url('index.php/product/delete/'.$row['product_id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
    </tr>     
        <?php }?>  
    </table>
   </div> 
  </div> 
 </body>
</html>