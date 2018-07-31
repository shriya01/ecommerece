<div class="container">
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
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
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="<?php echo base_url('uploads/').$items['image']; ?>" alt="..." class="img-responsive"/></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin"><?php echo $items['name']; ?></h4>
                            <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </td>
                <td data-th="Price"><?php echo $this->cart->format_number($items['price']); ?></td>
                <td data-th="Quantity">
                    <?php echo form_input('cart[' . $items['id'] . '][qty]', $items['qty'], 'maxlength="3" size="1"  style="text-align: right"'); ?>
                </td>
                <td data-th="Subtotal" class="text-center"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                <td class="actions" data-th="">
                    <a href="<?php echo base_url('product/remove/'). $items['rowid'];?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>                                
                </td>
            </tr>
            <?php $i++;
            endforeach;
            ?>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total 1.99</strong></td>
            </tr>
            <tr>
                <td><a href="<?php echo base_url('home'); ?>" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="1" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total <?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
                <td><input type="submit" class ='btn btn-success pull-right' value="Update Cart"></td>
                <?php echo form_close(); ?>
                <td><a class ='btn btn-success pull-right' value="Clear Cart" onclick="clear_cart()">Clear Cart</a></td>
                <td><a href="<?php echo base_url('paymentMethod/CheckOut');?>" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
            </tr>
        </tfoot>
    </table>
</div>
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