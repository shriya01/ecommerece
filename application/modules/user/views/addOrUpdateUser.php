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
				<?php if ($user_id != '') {
                    ?>
					<h2>Update Account Details</small></h2>
					<?php
                } else {
                    ?>
					<h2>Add New Account</small></h2>
					<?php
                } ?>
				<hr class="colorgraph">
				<?php 	$attributes = array('class' => 'register-form', 'id' => 'adduser','role' => 'form');
                echo form_open('', $attributes); ?>
				<?php  foreach ($user_info as $key) {
                    $firstname = 	$key['user_firstname'];
                    $lastname =    $key['user_lastname'];
                    $email = 	$key['user_email'];
                    $mobileNumber = 	$key['user_mobile'];
                    $gender = $key['user_gender'];
                }
                ?>
				<!-- Name Field -->
				<div class="form-group">
					<?php 
                    $name = array(
                        'name'          => 'firstname',
                        'id'            => 'name',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'First Name',
                        'tabindex' 		=> '3',
                        'value'			=> isset($firstname) ? $firstname : $this->input->post('firstname')
                        );
                    echo form_input($name);
                    ?>
				</div>
                    <!-- Name Field -->
                <div class="form-group">
                    <?php 
                    $name = array(
                        'name'          => 'lastname',
                        'id'            => 'name',
                        'class'         => 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder'   => 'Last Name',
                        'tabindex'      => '3',
                        'value'         => isset($lastname) ? $lastname : $this->input->post('lastname')
                        );
                    echo form_input($name);
                    ?>
                </div>
				<!-- Email Field -->
				<div class="form-group">
					<?php 
                    $email = array(
                        'name'          => 'email',
                        'id'            => 'email',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'Email',
                        'type'			=> 'email',
                        'tabindex' 		=> '3',
                        'value'			=> isset($email) ? $email : $this->input->post('email'),
                        );
                    echo form_input($email);
                    ?>
				</div>
				<?php if ($user_id == ''):
                ?>
				<!-- Password Field -->
				<div class="form-group">
					<?php 
                    $password = array(
                        'name'          => 'password',
                        'id'            => 'password',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'Password',
                        'type'			=>	'password',
                        'tabindex' 		=> '3',
                        );
                    echo form_input($password);
                    ?>
				</div>
				
			<?php endif; ?>
			<!-- Mobile Number Field -->
			<div class="form-group">
				<?php 
                $mobileNumber = array(
                    'name'          => 'mobileNumber',
                    'id'            => 'email',
                    'class'			=> 'form-control input-lg',
                    'maxlength'     => '100',
                    'placeholder' 	=> 'Mobile Number',
                    'tabindex' 		=> '3',
                    'value'			=> isset($mobileNumber) ? $mobileNumber : $this->input->post('mobileNumber')
                    );
                echo form_input($mobileNumber);
                ?>
			</div>
    
            <label class="radio-inline" >
     <?php  $data = array(
        'name'          => 'gender',
        'id'            => 'male',
        'value'         => '1',
        'checked'       => isset($gender)&&$gender == '1'? TRUE:FALSE,

);

echo form_radio($data); ?>Male
    </label>
    <label class="radio-inline">
           <?php  $data = array(
        'name'          => 'gender',
        'id'            => 'female',
        'value'         => '2',
        'checked'       => isset($gender)&&$gender == '2'? TRUE:FALSE,

);

echo form_radio($data); ?>Female
    </label>
    <label class="radio-inline">
           <?php  $data = array(
        'name'          => 'gender',
        'id'            => 'others',
        'value'         => '3',
        'checked'       => isset($gender)&&$gender == '3'? TRUE:FALSE,

);

echo form_radio($data); ?>Others
    </label>
       
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