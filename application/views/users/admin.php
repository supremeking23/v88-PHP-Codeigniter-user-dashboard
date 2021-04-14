<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php $this->load->view("/users/includes/styles")?>

    <title>Admin Dashboard</title>
</head>
<body>

<?php $this->load->view("/users/includes/nav")?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center  justify-content-between">
                <h2>Manage Users</h2>
                <a href="new" class="btn btn-primary btn-sm">Add new</a>
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
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="/show/1">Ivan Christian Jay Funcion</a></td>
                            <td>icjfuncion@gmail.com</td>
                            <td>Dec. 24th 2012</td>
                            <td>admin</td>
                            <td>
                                <a href="/edit/1">Edit</a> | <a href="/remove/1" role="button"  data-toggle="modal" data-target="#exampleModal">remove</a>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content text-white bg-danger">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete user: </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                               Are you sure ? 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            
            </div>
        </div>
    </div>
<?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>