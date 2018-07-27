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
                <?php if (isset($this->session->email)) {
                    ?>
                    <li class="active"><a href="#">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Products <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('admin/product/AddOrUpdateProduct'); ?>">Add Product</a></li>
                            <li><a href="<?php echo base_url('admin/product/'); ?>">View All Products</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Users <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('admin/addOrUpdateData'); ?>">Add User</a></li>
                            <li><a href="<?php echo base_url('admin/showuserlist'); ?>">View All Users</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Orders <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Add Order</a></li>
                            <li><a href="#">View All Orders</a></li>
                        </ul>
                    </li>
                </ul>
                <?php
            } ?>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($this->session->email)) {
                    ?>
                    <li><a href="<?php echo base_url('admin/logout'); ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="<?php echo base_url('admin/'); ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
                <?php
            } ?>
        </div>
    </div>
</nav>