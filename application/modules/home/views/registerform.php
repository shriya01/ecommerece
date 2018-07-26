<section id="content">
    <div class="container">
        <div class="row">
            <?php 
            if (isset($this->session->loginFailed)) {
                echo "<div class='text-center text-danger'>".$this->session->loginFailed."</div>";
            }
            ?>
            <?php echo validation_errors('<div class="text-center text-danger"> ', '</div>');?>
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <?php 
                $attributes = array('class' => 'loginform', 'id' => 'myform','role' => 'form');
                echo form_open('', $attributes);
                ?>
                <h2>Create New Account</h2>
                <div class="form-group">
                    <?php 
                    $firstnameOptions = ['type'=>'text','name'=>'firstname','id'=>'firstname','placeholder'=>'First Name','class'=>'form-control  input-lg', 'tabindex'=>'4'];
//Email Field
                    echo form_label('First Name', 'username', ['class'=>'sr-only']);
                    echo form_input($firstnameOptions); ?>
                </div>
                <div class="form-group">
                    <?php 
                    $lastnameOptions = ['type'=>'text','name'=>'lastname','id'=>'lastname','placeholder'=>'Last Name','class'=>'form-control  input-lg', 'tabindex'=>'4'];
//Email Field
                    echo form_label('Last Name', 'lastname', ['class'=>'sr-only']);
                    echo form_input($lastnameOptions); ?>
                </div>
                <div class="form-group">
                    <?php 
                    $email = ['name'=> 'email','id' =>'email', 'class'=>'form-control input-lg','maxlength'=> '100',
                    'placeholder'=>'Email','type'=> 'email','tabindex'=> '3','value'=>$this->input->post('email')?$this->input->post('email'):''];
                    echo form_label('Email', 'email', ['class'=>'sr-only']);
                    echo form_input($email);
                    ?>
                </div>
                <div class="form-group">
                    <?php 
//Password Field
                    echo form_label('Password', 'password', ['class'=>'sr-only']);
                    echo form_password('password', '', ['id'=>'password','class'=>'form-control input-lg','placeholder'=>'Password']); ?>
                </div>
                <div class="form-group">
                    <?php 
// Confirm Password Field
                    echo form_label('Confirm Password', 'passconf', ['class'=>'sr-only']);
                    echo form_password('passconf', '', ['id'=>'passconf','class'=>'form-control input-lg','placeholder'=>'Confirm Password']); ?>
                </div>

                <!-- Mobile Number Field -->
                <div class="form-group">
                    <?php 
                    $mobileNumber = array(
                        'name'          => 'mobileNumber',
                        'id'            => 'email',
                        'class'         => 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder'   => 'Mobile Number',
                        'tabindex'      => '3',
                        'value'         => isset($mobileNumber) ? $mobileNumber : $this->input->post('mobileNumber')
                        );
                    echo form_input($mobileNumber);
                    ?>
                </div>
                <label class="radio-inline" >
                    <?php  $data = array(
                        'name'          => 'gender',
                        'id'            => 'male',
                        'value'         => '1',
                        'checked'       => isset($gender)&&$gender == '1'? true:false,

                        );
                        echo form_radio($data); ?>Male
                    </label>
                    <label class="radio-inline">
                        <?php  $data = array(
                            'name'          => 'gender',
                            'id'            => 'female',
                            'value'         => '2',
                            'checked'       => isset($gender)&&$gender == '2'? true:false,

                            );
                            echo form_radio($data); ?>Female
                        </label>
                        <label class="radio-inline">
                            <?php  $data = array(
                                'name'          => 'gender',
                                'id'            => 'others',
                                'value'         => '3',
                                'checked'       => isset($gender)&&$gender == '3'? true:false,
                                );
                                echo form_radio($data); ?>Others
                            </label>
                            <?php echo form_submit('register', 'Register', ['class' => 'col-sm-3 btn btn-primary btn-block btn-sm','id'=>'register']); ?>

                            <?php echo form_close(); ?>
                            <a href="<?php echo base_url();?>home/login" class="pull-right">Already have a account ? Login here</a>
                        </div>
                    </div>
                </div>
            </section>