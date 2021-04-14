<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php $this->load->view("/users/includes/styles")?>

    <title>Home Page</title>
</head>
<body>

<?php $this->load->view("/users/includes/nav")?>

    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to the Test!</h1>
            <p class="lead">We're going to build a cool application using a MVC framework! this application was build with the village88 folks.</p>
            <hr class="my-4">
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Start</a>
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <h2>Manage Users</h2>
                <p>Using this application, you'll learn how to add, remove , and edit users for the application</p>
            </div>
            <div class="col-md-4 col-sm-12">
                <h2>Leave messages</h2>
                <p>Users will be able to leave a message to another user using this application</p>
            </div>
            <div class="col-md-4 col-sm-12">
                <h2>Edit User Information</h2>
                <p>Admins will be able to edit another user's information (email address, first name, last name, etc)</p>
            </div>
        </div>
    </div>
<?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>