<?php include 'includes/init.php';

if(!$session->is_signed_in()){
    redirect("login.php");
}

if(empty($_GET['id'])){

    redirect("comments.php");
} 

$comment = comment::find_by_id($_GET['id']);
if($comment){
    $comment->delete();
    $session->message("This comment record: <b>{$comment->id}</b> belong to <b>{$comment->author}</b> has been delete ");
    redirect("comments.php");
} else {
    redirect("comments.php");
}
?> 