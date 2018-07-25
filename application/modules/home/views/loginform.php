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
        <h2>Sign in</h2>
        <hr class="colorgraph">
        <div class="form-group">
          <?php 
          $emailOptions = ['type'=>'email','name'=>'email','id'=>'email','placeholder'=>'Email Address','class'=>'form-control  input-lg', 'tabindex'=>'4'];
//Email Field
          echo form_label('Email', 'email', ['class'=>'sr-only']);
          echo form_input($emailOptions); ?>
        </div>
        <div class="form-group">
          <?php 
//Password Field
          echo form_label('Password', 'password', ['class'=>'sr-only']);
          echo form_password('password', '', ['id'=>'password','class'=>'form-control input-lg','placeholder'=>'Password']); ?>
        </div>
        <hr class="colorgraph">
        <div class="row">
          <div class="col-xs-12 col-md-3"><?php echo form_submit('login', 'Login', ['class' => 'btn btn-primary btn-block btn-lg','id'=>'login']); ?>
          </div>
        </div>
        <?php echo form_close(); ?>
        <a href="<?php echo base_url();?>home/register" class="pull-right">Create Your Account Here</a>
      </div>
    </div>
  </div>
</section>