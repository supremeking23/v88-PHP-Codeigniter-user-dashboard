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
<?php foreach($users as $user):?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><a href="show/<?=$user["id"]?>"><?= $user['first_name'] .' '. $user['last_name']?></a></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= date_format(date_create($user['created_at']), "M. jS Y")?></td>
                            <td><?= ($user['user_level'] == 9) ? "Admin" :""?><?= ($user['user_level'] == 1) ? "Normal" :""?></td>
                            <td>
<?php if($this->session->userdata("user_id") != $user['id']):?>
                                <a href="edit/<?= $user['id'] ?>">Edit</a> | <a role="button" href=""
                                 data-toggle="modal" data-target="#delete<?= $user['id'] ?>">remove</a>
                                <!-- Modal -->
                                <div class="modal fade" id="delete<?= $user['id'] ?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header text-white bg-danger">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete user: #<?= $user['id'] ?> </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-danger">
                                               <p>Are you sure ?</p>
                                               <p>This action is irreversible, Are you sure you want to remove user:  <?= $user['email']?></p> 

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php endif;?>
                            </td>
                        </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            
            </div>
        </div>
    </div>
<?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>