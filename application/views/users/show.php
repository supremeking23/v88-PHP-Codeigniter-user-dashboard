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
        .message h2, .message span{
            display:inline-block;
            vertical-align:middle;
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

        <div class="row content-background p-4">
            <div class="col-md-12">
                <h1><?= $user['first_name']?> <?= $user['last_name']?></h1>
                <!-- <a href="<?php echo base_url(); ?>admin">link</a> -->
            </div>
        </div>
        <dl class="row mt-3 content-background p-4">
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#post-message">
                Post a Message
                </button>
                <!-- Modal -->
                <div class="modal fade post-message-reply" id="post-message" tabindex="-1" aria-labelledby="post-message" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content content-background">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Leave a message for <?= $user['first_name']?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?= form_open("messages/post_message_process"); ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="message_from" value="<?= $this->session->userdata("user_id")?>">
                                        <input type="hidden" name="message_to" value="<?= $user['id']?>">
                                        <textarea class="form-control" id="post_message" name="post_message" rows="3"></textarea>
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

        <!-- messages -->
        <div class="row mt-5">
<?php foreach($messages as $message):?>
<?php 
$date = date_create($message["created_at"]);
$format_date = date_format($date,"F dS Y");    

$scatter_date_info = explode(" ",dateDifference($message["created_at"]));    

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

$count = $this->reply->get_reply_count_by_message_id($message['message_id']);
?>
            <div class="col-md-12 message mb-5 content-background" style="">
                <h2><?=$message["first_name"]?> <?=$message["last_name"]?></h2>
                <span class="float-right"><?= $time?></span>
                <p><?=$message["message"]?></p>
                <a href="<?= base_url()?>show/<?=$user['id']?>/<?=$message['message_id']?>" class="float-right">(<?= (!(is_null($count)) ? $count["reply_count"] : 0)?>) replies</a>
            </div>
<?php endforeach; ?>
        </div>

    </div>
<?php $this->load->view("/users/includes/scripts")?>
  </body>
</html>


