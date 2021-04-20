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
            <div class="col-md-12 col-sm-12 content-background p-0">
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
<?php foreach($users as $user):?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><a href="show/<?= $user['id'] ?>"><?= $user['first_name'] .' '. $user['last_name']?></a></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= date_format(date_create($user['created_at']), "M. jS Y")?></td>
                            <td><?= ($user['user_level'] == 9) ? "Admin" :""?><?= ($user['user_level'] == 1) ? "Normal" :""?></td>
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