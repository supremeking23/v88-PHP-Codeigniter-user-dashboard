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
        <div class="row mb-5">
            <div class="col-md-6 col-sm-12">
                <h2 class="">Edit Profile</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
              
                <form >
                    <fieldset>
                        <legend>Edit Information:</legend>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email"  placeholder="Enter email">
                            
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" placeholder="First Name of the user">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Last Name of the user">
                        </div>

                        <button type="submit" class="btn btn-success float-right">Save</button>
                        <div class="clearfix"></div>
                    </fieldset>
                </form>
            
            </div>

            <div class="col-md-6 col-sm-12">
                <form>
                    <fieldset>
                        <legend>Change Password:</legend>
                      
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="password">Password Confirmation</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-success float-right">Update Password</button>
                        <div class="clearfix"></div>
                    </fieldset>
                </form>
            
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
               <form>
                    <fieldset>
                        <legend>Edit Description:</legend>
                      
                        <div class="form-group">
                            <textarea class="form-control" id="description" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success float-right">Save</button>
                        <div class="clearfix"></div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>