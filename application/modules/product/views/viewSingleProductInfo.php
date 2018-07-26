<div class="container">
	 <table class="table table-bordered">
     <tr>
   
      <td><strong>Product Name</strong></td>
      <td><strong>product description</strong></td>
      <td><strong>product price</strong></td>
      <td><strong>product discount</strong></td>
      <td><strong>category name</strong></td>
      <td style="width:30%;" class="text-center"><strong>Action</strong></td>

    </tr> 
     <?php 
	
	 foreach ($product_info as $row)  
	 {?>
     <tr> 
      <td><?php echo $row['product_name'];?></td>
      <td><?php echo  $row['product_description'];?></td>
      <td><?php echo $row['product_price'];?></td>
      <td><?php echo $row['product_discount'];?></td>
    <td></td>

  <td style="width:30%;" class="text-center">
            <a href="<?php echo base_url('product/deleteProductData/'.aes256encrypt($row['product_id'])); ?>"><button class="btn-sm btn-danger glyphicon glyphicon-trash"></button></a>
            <a href="<?php echo base_url('product/addOrUpdateProduct/'.aes256encrypt($row['product_id'])); ?>"><button class="btn-sm btn-success glyphicon glyphicon-edit"></button></a>
            <a href="<?php echo base_url('product/showProductData/'.aes256encrypt($row['product_id'])); ?>"><button class="btn-sm btn-primary glyphicon glyphicon-eye-open"></button></a>
          </td>    </tr>     
        <?php }?>  
    </table>
	<a href="<?php echo base_url().'product/'; ?>"><button class="btn-primary btn-sm">Go Back</button></a>
</div>