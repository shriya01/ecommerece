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
				<?php if ($payment_method_id != '') {
					?>
					<h2>Update Payment Method Details</small></h2>
					<?php
				} else {
					?>
					<h2>Add New Payment Method</small></h2>
					<?php
				} ?>
				<hr class="colorgraph">
				<?php 	$attributes = array('class' => 'register-form', 'id' => 'productform','role' => 'form');
				echo form_open('', $attributes); ?>
				<?php  foreach ($payment_method_info as $key){
					$name = 	$key['payment_method_name'];
				}
				?>
				<!-- Name Field -->
				<div class="form-group">
					<?php 
					$name = array(
						'name'          => 'payment_method_name',
						'id'            => 'payment_method_name',
						'class'			=> 'form-control input-lg',
						'maxlength'     => '100',
						'placeholder' 	=> 'Name',
						'tabindex' 		=> '3',
						'value'			=> isset($name) ? $name : $this->input->post('payment_method_name')
						);
					echo form_input($name);
					?>
				</div>

				<div class="row">
					<div class="col-xs-12 col-md-3">
						<?php 
						echo form_submit('addOrUpdatePaymentMethod', 'SAVE', array('class'=>'btn btn-primary btn-lg','tabindex'=>'7'));
						?>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>
