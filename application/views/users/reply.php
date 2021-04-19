<?php 

function dateDifference($date_1  , $differenceFormat = '%y %m %d %h %i %s')
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create();
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php $this->load->view("/users/includes/styles")?>

    <style>
        .reply h2, .message span{
            display:inline-block;
            vertical-align:middle;
        }

        .reply h2 {
            padding-bottom:1rem;
        }
        .reply p {
            border-top:1px solid #000;
            padding-top:1rem;
        }


    </style>

    <title>Admin Information</title>
</head>
<body>

<?php $this->load->view("/users/includes/nav")?>


    <div class="container mt-5">
<?php $this->load->view("/users/includes/errors")?>

<?php if($this->session->flashdata("post-message-success")):?>
        <div class="row">
            <div class="col md-12">
<?= $this->session->flashdata("post-message-success");?>
            </div>
        </div>
<?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <!-- <h1><?= $user['first_name']?> <?= $user['last_name']?></h1> -->
                <!-- <a href="<?php echo base_url(); ?>admin">link</a> -->
            </div>
        </div>
        <dl class="row mt-3">
            <dt class="col-sm-3">Message to: </dt>
            <dd class="col-sm-9"><?= $user["first_name"]?> <?= $user["last_name"]?> </dd>
            <dt class="col-sm-3">Message from: </dt>
            <dd class="col-sm-9"><?= $message["first_name"]?> <?= $message["last_name"]?></dd>
            <dt class="col-sm-3">Date: </dt>
            <dd class="col-sm-9"><?= date_format(date_create($message['created_at']), "F jS Y")?></dd>
            <dt class="col-sm-3">Message Content:  </dt>
            <dd class="col-sm-9"><?= $message["message"]?></dd>
        </dl>

        <div class="row">
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#post-reply">
                Reply to this message
                </button>
                <!-- Modal -->
                <div class="modal fade post-message-reply" id="post-reply" tabindex="-1" aria-labelledby="post-message" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Reply to  <?= $message['first_name']?> <?= $message["last_name"]?> message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?= form_open("replies/post_reply_process"); ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="reply_from" value="<?= $this->session->userdata("user_id")?>">
                                        <input type="hidden" name="message_id" value="<?=$message["message_id"]?>">
                                        <input type="hidden" name="message_to" value="<?=$user['id']?>">
                                        <textarea class="form-control" id="post_reply" name="post_reply" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Post</button>
                                </div>
                            <?= form_close();?>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Replies on this message:</h2>
            </div>
        </div>

        <!-- messages -->
        <div class="row mt-5">
<?php foreach($replies as $reply):?>
<?php 
$date = date_create($reply["created_at"]);
$format_date = date_format($date,"F dS Y");    

$scatter_date_info = explode(" ",dateDifference($reply["created_at"]));    

if((int) $scatter_date_info[0] >= 1){
    $time = "{$scatter_date_info[0]} year(s) ago";
}else if ((int) $scatter_date_info[1] >= 1){
    $time = "{$scatter_date_info[1]} months ago";
}else if ((int) $scatter_date_info[2] >=1){
    $time = "{$scatter_date_info[2]} days ago";
}else if ((int) $scatter_date_info[3] >= 1){
    $time = "{$scatter_date_info[3]} hours ago";
}else if ((int) $scatter_date_info[4] >= 1){
    $time = "{$scatter_date_info[4]} minutes ago";
}else if ((int) $scatter_date_info[5] >=0){
   $time = "{$scatter_date_info[5]} seconds ago";
}else{
    // $time ="sds";
}

?>
            <div class="col-md-12 reply mb-5" style="border:1px solid #000;padding:1rem;border-radius:1.5rem">
                <h2><?=$reply["first_name"]?> <?=$reply["last_name"]?> <small class="text-muted">wrote</small></h2>
                <span class="float-right"><?= $time?></span>
                <p><?=$reply["reply"]?></p>
            </div>
<?php endforeach; ?>
        </div>

    </div>
<?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>



<!-- 
<h2>Leave a message for <?= $user['first_name']?></h2>
                <?= form_open("users/edit_profile_process");?>
                     <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Post</button>
                    <div class="clearfix"></div>
</form> -->