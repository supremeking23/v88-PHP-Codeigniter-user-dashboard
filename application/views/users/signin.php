<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php $this->load->view("/users/includes/styles")?>

    <title>Signin Page</title>
</head>
<body>

<?php $this->load->view("/users/includes/nav")?>


    <div class="container mt-5">

<?php $this->load->view("/users/includes/errors")?>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h2>Signin</h2>
                
                <form action="users/signin_process" method="POST">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" id="email" name="email"  placeholder="Enter email">
                        
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-success float-right">Submit</button>
                    <div class="clearfix"></div>
                </form>
            
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <a href="register">Don't have an account? Register</a>
            </div>
        </div>
    </div>
    <?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>