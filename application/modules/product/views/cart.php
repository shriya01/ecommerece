<script type="text/javascript">
// To conform clear all data in cart.
function clear_cart() {
    var result = confirm('Are you sure want to clear all bookings?');
    if (result) {
        window.location = "<?php echo base_url(); ?>index.php/product/remove/all";
    } else {
return false; // cancel button
}
}
</script>
<div class="container">
    <div id="text"> 
        <?php  $cart_check = $this->cart->contents();
// If cart is empty, this will show below message.
        if(empty($cart_check)) {
            echo 'To add products to your shopping cart click on "Add to Cart" Button'; 
        }  ?> </div>
        <table id="cart" class="table table-hover table-condensed">


            <thead>
                <tr>
                    <th style="width:50%">Product image </th>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>

                    <th>Cancel Product</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo form_open('product/update_cart'); 
                $i = 1; 
                $grand_total = 0;
                ?>
                <?php 
                $cart = $this->cart->contents();
                foreach ($cart as $items): 
                    echo form_hidden('cart[' . $items['id'] . '][id]', $items['id']);
                echo form_hidden('cart[' . $items['id'] . '][rowid]', $items['rowid']);
                echo form_hidden('cart[' . $items['id'] . '][name]', $items['name']);
                echo form_hidden('cart[' . $items['id'] . '][price]', $items['price']);
                echo form_hidden('cart[' . $items['id'] . '][qty]', $items['qty']);
                ?>
                <tr>
                    <td>
                        <div class="col-sm-2 hidden-xs"><img style="height:100px; width:100px;" src="<?php echo base_url('uploads/').$items['image']; ?>" alt="..." /></div>

                    </td>
                    <td data-th="Product">
                        <h4 class="nomargin"><?php echo $items['name']; ?></h4>
                        <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                    </td>
                    <td data-th="Price"><?php echo $this->cart->format_number($items['price']); ?>

                    </td>
                    <td>
                        <?php echo form_input('cart[' . $items['id'] . '][qty]', $items['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                    </td>
                    <?php $grand_total = $grand_total + $items['subtotal']; ?>
                    <td>
                        <?php echo number_format($items['subtotal'], 2) ?>
                    </td>
                    <td>
                <?php 
// cancle image.
                        $path = "<img src='http://localhost/codeigniter_cart/images/cart_cross.jpg' width='25px' height='20px'>";
                        echo anchor('Product/remove/' . $items['rowid'], $path); ?>
                    </td>
                </tr>
                <?php $i++;
                endforeach;
                ?>
            </tbody>
            <tfoot>
                <tr >
                    <td class="hidden-xs text-center"><strong>Order Total <?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
                    <td colspan="6" align="right"><input type="button" class ='fg-button teal' value="Clear Cart" onclick="clear_cart()">

                        <?php //submit button. ?>
                        <input type="submit"  class ='fg-button teal' value="Update Cart">
                        <?php echo form_close(); ?>

                        <!-- "Place order button" on click send "billing" controller  -->
                        <a href="<?php echo base_url('product/billing_view'); ?>"> <input type="button" class ='fg-button teal' value="Place Order" ></a>
                    </td>
                    <td><a href="<?php echo base_url('paymentMethod/CheckOut');?>" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                </tr>
                <tr> <td><a href="<?php echo base_url('home'); ?>" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td></tr>
            </tfoot>
        </table>
    </div>