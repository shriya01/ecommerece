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
<script type="text/javascript">
	$(document).ready(function() {
		$('#btnChangePwd').click(function()
		{
					submitForm();

		});
    function submitForm() {
        var data = $("#forgotpasswordadmin").serialize();
        console.log('data'+data);
        $.ajax({
            type: 'POST',
            url: base_url+'admin/forgotPasswordHandle',
            data: data,
            dataType: "json",
            beforeSend: function() {
                $("#error").fadeOut();
                $("#btnChangePwd").html('<span class="glyphicon glyphicon-transfer"></span>please wait ...');
            },
            success: function(response) {
            	console.log(response);
                if (response == true) {
                    $("#btnChangePwd").html('Change Password');
                    $("#error").show();
                    $("#error").html('<div class="alert alert-danger">Password is incorrect</div>');
                    setTimeout(function() {
                        $('#error').fadeOut('slow');
                    }, 5000);
                } else if (response == false) {
                    $("#btnChangePwd").html('<img src="images/ajax-loader.png" style="width:30px; height:30px;" />  Changing Password ...');
                    $("#success").html('<div class="alert alert-success">Password Updated Successfully</div>');

                    setTimeout(function() {
                        $('#success').fadeOut('fast');
                    }, 1000);
                }
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
        return false;
    }
});
</script>