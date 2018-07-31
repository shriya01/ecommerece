
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
                           <?php $i = 1; ?>
                        <?php 
                        foreach ($this->cart->contents() as $items): ?>
                                                <tr>

                            <td data-th="Product">
                                <div class="row">
                           
                                    <div class="col-sm-2 hidden-xs"><img src="<?php echo base_url('uploads/').$image; ?>" alt="..." class="img-responsive"/></div>

                                    <div class="col-sm-10">
                                        <h4 class="nomargin"><?php echo $items['name']; ?></h4>
                                        <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price"><?php echo $this->cart->format_number($items['price']); ?></td>
                            <td data-th="Quantity">
                                <input type="number" class="form-control text-center" value="<?php echo $items['qty']; ?>">
                            </td>
                            <td data-th="Subtotal" class="text-center"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                            <td class="actions" data-th="">
                                <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>                                
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
                            <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><strong>Total <?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
                            <td><a href="<?php echo base_url('paymentMethod/CheckOut');?>" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                            <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                        </tr>
                    </tfoot>
                </table>
</div>