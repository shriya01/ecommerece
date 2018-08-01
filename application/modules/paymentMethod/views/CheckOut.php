<?php
echo validation_errors('<div class="text-danger text-center">','</div>'); 
?>
<div class="container wrapper">
    <div class="row cart-head">
        <div class="container">
            <div class="row">
                <p></p>
            </div>
            <div class="row">
                <p></p>
            </div>
        </div>
    </div>    
    <div class="row cart-body">
        <form class="form-horizontal" method="post" action="">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                <!--SHIPPING METHOD-->
                <div class="panel panel-info">
                    <div class="panel-heading">Address</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <h4>Shipping Address</h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php   
                            foreach ($user_info as $key) {
                                $firstname =    $key['user_firstname'];
                                $lastname =    $key['user_lastname'];
                                $address = $key['user_address'];
                                $email =    $key['user_email'];
                                $mobile_number =     $key['user_mobile'];
                                $country = $key['user_country'];
                                $zip_code = $key['user_zipcode'];
                                $city = $key['user_city'];
                                $state = $key['user_state'];
                            }
                            ?>
                            <div class="col-md-12"><strong>Country:</strong></div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="country" name="country" value="<?php echo isset($country) ? $country : $this->input->post('country'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <strong>First Name:</strong>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo isset($firstname) ? $firstname : $this->input->post('firstname'); ?>" />
                            </div>
                            <div class="form-group"></div>
                            <div class="col-md-6 col-xs-12">
                                <strong>Last Name:</strong>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo isset($lastname) ? $lastname : $this->input->post('lastname'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Address:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="address" id="address" class="form-control" value="<?php echo isset($address) ? $address : $this->input->post('address'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>City:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="city" id="city" class="form-control" value="<?php echo isset($city) ? $city : $this->input->post('city'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>State:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="state" class="form-control" value="<?php echo isset($state) ? $state : $this->input->post('state'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="zip_code" class="form-control" value="<?php echo isset($zip_code) ? $zip_code : $this->input->post('zip_code'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Phone Number:</strong></div>
                            <div class="col-md-12"><input type="text" name="mobile_number" class="form-control" value="<?php echo isset($mobile_number) ? $mobile_number : $this->input->post('mobile_number'); ?>" /></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Email Address:</strong></div>
                            <div class="col-md-12"><input type="text" name="email" class="form-control" value="<?php echo isset($email) ? $email : $this->input->post('email'); ?>" /></div>
                        </div>
                        <?php if(!isset($this->session->user_id)) { ?>
                                <div class="form-group">
                            <div class="col-md-12"><strong>Password:</strong></div>
                            <div class="col-md-12"><input type="password" name="password" class="form-control" value="" /></div>
                        </div>
                                         <div class="form-group">
                            <div class="col-md-12"><strong>Confirm Password:</strong></div>
                            <div class="col-md-12"><input type="password" name="passconf" class="form-control" value="" /></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!--SHIPPING METHOD END-->
                <!--CREDIT CART PAYMENT-->
                <div class="panel panel-info">
                    <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12"><strong>Card Type:</strong></div>
                            <div class="col-md-12">
                                <?php
                                array_unshift($payment_methods,'Select Payment Method');
                                $selected = isset($payment_method_id) ?$payment_method_id : 0;
                                $js = 'id="payment_method_name" class="form-control" ';
                                echo form_label('Payment Method Name','payment_method_name',['class'=>'sr-only']);
                                echo form_dropdown('payment_method_name', $payment_methods,$selected,$js);
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary btn-submit-fix">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--CREDIT CART PAYMENT END-->
            </div>
        </form>
</div>