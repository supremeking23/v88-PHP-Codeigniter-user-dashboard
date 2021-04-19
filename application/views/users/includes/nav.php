    <?php 

    ?>
    <nav class="navbar navbar-expand-lg navbar-dark nav-background sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Village88</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ">
    <?php if($this->session->userdata("is_logged_in") === TRUE){?>
        <?php if($this->session->userdata("user_level") == 9){ ?>
                    <li class="nav-item <?=($this->session->userdata("active_link") == "dashboard") ? "active" :"" ?>">
                        <a class="nav-link" href="<?php echo base_url(); ?>admin">Dashboard</a>
                    </li>
        <?php }else if($this->session->userdata("user_level") == 1){ ?>
                    <li class="nav-item <?=($this->session->userdata("active_link") == "dashboard") ? "active" :"" ?>">
                        <a class="nav-link" href="<?php echo base_url(); ?>dashboard">Dashboard</a>
                    </li>
        <?php } ?>
                    <li class="nav-item <?=($this->session->userdata("active_link") == "profile") ? "active" :"" ?>">
                        <a class="nav-link" href="<?php echo base_url(); ?>edit">Profile</a>
                    </li>
    <?php }else{ ?>
                    <li class="nav-item <?=($this->session->userdata("active_link") == "home") ? "active" :"" ?>">
                        <a class="nav-link" href="<? echo base_url();?>">Home <span class="sr-only">(current)</span></a>
                    </li>
    <?php } ?>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
    <?php if($this->session->userdata("is_logged_in") === TRUE){?>
                        <a class="nav-link" href="<?php echo base_url(); ?>logoff">Log Off</a>
    <?php }else{ ?>
                        <a class="nav-link" href="<?php echo base_url(); ?>signin">Sign In</a>
    <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>