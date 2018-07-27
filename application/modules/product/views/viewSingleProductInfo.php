<div class="container">
  <table class="table table-bordered">
    <tr>

      <td><strong>Product Name</strong></td>
      <td><strong>Product Description</strong></td>
      <td><strong>Product Price</strong></td>
      <td><strong>Product Discount</strong></td>
      <td><strong>Product Selling Price</strong></td>
      <td><strong>Category Name</strong></td>
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
      <td><?php echo $row['product_selling_price']; ?></td>
      <td><?php echo $row['category_name']; ?></td>

      <td style="width:30%;" class="text-center">
        <a href="<?php echo base_url('product/deleteProductData/'.aes256encrypt($row['product_id'])); ?>"><button class="btn-sm btn-danger glyphicon glyphicon-trash"></button></a>
        <a href="<?php echo base_url('product/addOrUpdateProduct/'.aes256encrypt($row['product_id'])); ?>"><button class="btn-sm btn-success glyphicon glyphicon-edit"></button></a>
        <a href="<?php echo base_url('product/showProductData/'.aes256encrypt($row['product_id'])); ?>"><button class="btn-sm btn-primary glyphicon glyphicon-eye-open"></button></a>
      </td>    </tr>     
      <?php }?>  
    </table>
    <a href="<?php echo base_url().'product/'; ?>"><button class="btn-primary btn-sm">Go Back</button></a>
  </div>