<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php $this->load->view("/users/includes/styles")?>

    <title>User Dashboard</title>
</head>
<body>

<?php $this->load->view("/users/includes/nav")?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>All Users</h2>
               
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                            <th scope="col">User level</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="/show/1">Ivan Christian Jay Funcion</a></td>
                            <td>icjfuncion@gmail.com</td>
                            <td>Dec. 24th 2012</td>
                            <td>admin</td>
                           
                        </tr>
                    </tbody>
                </table>
            
            </div>
        </div>
    </div>
<?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>