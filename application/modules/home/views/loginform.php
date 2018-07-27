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


                <div class="form-group">
                    <?php 
                    $email = ['name'=> 'email','id' =>'email', 'class'=>'form-control input-lg','maxlength'=> '100',
                    'placeholder'=>'Email','type'=> 'email','tabindex'=> '3','value'=>$this->input->post('email')?$$this->input->post('email'):''];
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
 

                            <?php echo form_submit('login', 'Login', ['class' => 'col-sm-3 btn btn-primary btn-block btn-sm','id'=>'register']); ?>

                            <?php echo form_close(); ?>
                            <a href="<?php echo base_url();?>home/login" class="pull-right">Already have a account ? Login here</a>
                        </div>
                    </div>
                </div>
            </section>