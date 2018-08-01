<div class="container">
	<div class="row">
	<div id="error"></div>
	<div id="success"> </div>
		<div class="col-sm-6 col-md-4 col-md-offset-4" style="margin-top: 12%">
			<?php 
			if (isset($this->session->loginFailed)) {
				echo "<div class='text-center text-danger'>".$this->session->loginFailed."</div>";
			}
			?>
			<?php echo validation_errors('<div class="text-danger">', '</div>'); ?>
			<h1 class="text-center login-title">E-Shop Login</h1>
			<div class="account-wall">
				<img class="profile-img" src="<?php echo base_url('assets/admin/images/login-icon.png'); ?>" alt="">
				<form id="forgotpasswordadmin" method="post" class="form-login" action="">
					<input type="text" name="email" class="form-control" placeholder="Email" required >
					<hr />
					<button class="btn btn-lg btn-primary btn-block" id="btnChangePwd" type="submit">Sign in</button>
				</form>
				<a href="<?php echo base_url();?>admin/forgotPassword">Forgot Password</a>
			</div>
		</div>
	</div> <!-- /.row -->
</div><!-- /.container -->