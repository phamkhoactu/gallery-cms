<?php include 'includes/header.php';
if (!$session->is_signed_in()) {
    redirect("login.php");

}

$message = "";
if (isset($_FILES['file'])) {
    $photo        = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file']);

    if ($photo->save()) {
        $message = "Photo uploaded Succesfully";
    } else {
        $message = join("<br>", $photo->errors);
    }

}
?>

        <!-- Navigation -->

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->


            <?php include 'includes/top-nav.php';?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->


            <?php include 'includes/side-nav.php';?>
            <!-- /.navbar-collapse -->
        </nav>


        <div id="page-wrapper">



           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            UPLOAD
                            <small>Subheading</small>
                        </h1>
                        <div class="row">
                            
                       
                        <div class="col-md-6">
                        <?php echo $message; ?>
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" name="title" value="" placeholder="" class="form_control">
                                </div>

                                <div class="form-group">
                                    <input type="file" name="file" value="" placeholder="" class="form_control">
                                </div>

                                <input type="submit" name="submit" value="Submit">

                        </form>
                        </div>
                         </div>

                         <div class="row">
                             <div class="col-lg-12">
                                 <form action="upload.php" class="dropzone">
                                     
                                 </form>
                             </div>
                         </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>


            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/footer.php';?>