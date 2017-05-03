<?php include 'includes/init.php';

if(!$session->is_signed_in()){
    redirect("login.php");
}

if(empty($_GET['id'])){
    redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['id']);
if($photo){
	$session->message("This photo record: <b>{$photo->filename}</b> has been updated ");
    $photo->delete_photo();
    redirect("photos.php");
} else {
    redirect("photos.php");
}
?> 