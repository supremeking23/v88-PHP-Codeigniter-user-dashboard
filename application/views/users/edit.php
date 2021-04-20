<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php $this->load->view("/users/includes/styles")?>
    <style>
        fieldset {
            background-color: #eeeeee;
            padding:20px
        }
        legend {
            background-color: gray;
            color: white;
            padding: 5px 10px;
            width:50%
        }
    </style>
    <title>Edit Profile</title>
</head>
<body>

<?php $this->load->view("/users/includes/nav")?>


    <div class="container mt-5">
<?php $this->load->view("/users/includes/errors")?>
<?php if($this->session->flashdata("edit-user-info-success")):?>
        <div class="row">
            <div class="col md-12">
<?= $this->session->flashdata("edit-user-info-success");?>
            </div>
        </div>
<?php endif; ?>

<?php if($this->session->flashdata("edit-user-password-success")):?>
        <div class="row">
            <div class="col md-12">
<?= $this->session->flashdata("edit-user-password-success");?>
            </div>
        </div>
<?php endif; ?>

<?php if($this->session->flashdata("edit-user-description-success")):?>
        <div class="row">
            <div class="col md-12">
<?= $this->session->flashdata("edit-user-description-success");?>
            </div>
        </div>
<?php endif; ?>

        <div class="row mb-5">
            <div class="col-md-6 col-sm-12">
                <h2 class="">Edit Profile</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
              
            <?= form_open("users/edit_profile_process");?>
                    <fieldset>
                        <legend>Edit Information:</legend>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email" value="<?=$user_info["email"]?>">
                            
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name of the user" value="<?=$user_info["first_name"]?>">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name of the user" value="<?=$user_info["last_name"]?>">
                        </div>

<?php if($this->session->userdata("user_level") == 9):?>
                        <div class="form-group">
                            <label for="user-level">User Level</label>
                            <select class="form-control" name="user-level" id="user-level">
                                <option value="1" <?= ($user_info["user_level"] == 1) ? "selected" :""?>>Normal</option>
                                <option value="9" <?= ($user_info["user_level"] == 9) ? "selected" :""?>>Admin</option>
                            </select>
                        </div>
<?php endif; ?>
                        <input type="hidden" name="process-type" value="edit-info">
                        <input type="hidden" name="user-id" value="<?=$user_info["id"];?>">
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                        <div class="clearfix"></div>
                    </fieldset>
                </form>
            
            </div>

            <div class="col-md-6 col-sm-12">

            <?= form_open("users/edit_profile_process");?>
                    <fieldset>
                        <legend>Change Password:</legend>
                      
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Password Confirmation</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password">
                        </div>
                        <input type="hidden" name="process-type" value="edit-password">
                        <input type="hidden" name="user-id" value="<?=$user_info["id"];?>">
                        <button type="submit" class="btn btn-primary float-right">Update Password</button>
                        <div class="clearfix"></div>
                    </fieldset>
                </form>
            
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
            <?= form_open("users/edit_profile_process");?>
                    <fieldset>
                        <legend>Edit Description:</legend>
                      
                        <div class="form-group">
                            <textarea class="form-control" id="description" name="description" rows="3"><?=$user_info["description"];?></textarea>
                        </div>
                        <input type="hidden" name="process-type" value="edit-description">
                        <input type="hidden" name="user-id" value="<?=$user_info["id"];?>">
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                        <div class="clearfix"></div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>