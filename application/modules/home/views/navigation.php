<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="#"><img src="<?php echo base_url('assets/admin/images/logo.png'); ?>"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <?php if (isset($this->session->user_email)) {
                    ?>
                    <li class="active"><a href="#">Home</a></li>
                    <li ><a  href="#">Products </a></li>
                </ul>
                <?php
            } ?>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($this->session->user_email)) {
                    ?>
                    <li><a href="<?php echo base_url('home/logout'); ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="<?php echo base_url('home/login'); ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
                <?php
            } ?>
        </div>
    </div>
</nav>