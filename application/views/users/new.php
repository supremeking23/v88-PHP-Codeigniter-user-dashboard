<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php $this->load->view("/users/includes/styles")?>

    <title>New User</title>
</head>
<body>

<?php $this->load->view("/users/includes/nav")?>


    <div class="container mt-5">
<?php $this->load->view("/users/includes/errors")?>

<?php if($this->session->flashdata("add-user-success")):?>
        <div class="row">
            <div class="col md-12">
<?= $this->session->flashdata("add-user-success");?>
            </div>
        </div>
<?php endif; ?>

        <div class="row">
            <div class="col-md-12 d-flex align-items-center  justify-content-between">
                <h2>Add a new user</h2>
                <a href="<?= base_url();?>admin" class="btn btn-primary btn-sm">Return to Dashboard</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 col-sm-12">
                <?= form_open("users/add_new_process");?>
                <!-- <form action="users/add_new_process" method="POST"> -->
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" id="email" name="email"  placeholder="Enter email">
                        
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name"  name="first_name"  placeholder="Enter First Name">
                        
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Password Confirm</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                    </div>

                    <button type="submit" class="btn btn-success float-right">Create</button>
                    <div class="clearfix"></div>
                </form>
            
            </div>
        </div>

    </div>
<?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>