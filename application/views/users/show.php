<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php $this->load->view("/users/includes/styles")?>

    <title>Admin Information</title>
</head>
<body>

<?php $this->load->view("/users/includes/nav")?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $user['first_name']?> <?= $user['last_name']?></h1>
                <!-- <a href="<?php echo base_url(); ?>admin">link</a> -->
            </div>
        </div>
        <dl class="row mt-3">
            <dt class="col-sm-3">Registered at : </dt>
            <dd class="col-sm-9"><?= date_format(date_create($user['created_at']), "F jS Y")?></dd>
            <dt class="col-sm-3">User ID at : </dt>
            <dd class="col-sm-9"># <?= $user['id']?></dd>
            <dt class="col-sm-3">Email address : </dt>
            <dd class="col-sm-9"><?= $user['email']?></dd>
            <dt class="col-sm-3">Description : </dt>
            <dd class="col-sm-9"><?= $user['description']?></dd>
        </dl>

        <div class="row">
            <div class="col-md-12">
                <h2>Leave a message for <?= $user['first_name']?></h2>
                <?= form_open("users/edit_profile_process");?>
                     <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Post</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
<?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>