 <?php include 'includes/header.php';
if (!$session->is_signed_in()) {
    redirect("login.php");
}
?>

<?php

// $user = User::find_by_id($_GET['id']);
$user = new User();
if (isset($_POST['create'])) {

    if ($user) {
        $user->username   = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name  = $_POST['last_name'];
        $user->password   = $_POST['password'];

        $user->set_file($_FILES['user_image']);
        if($user->upload_photo()){
            echo "OK";
        }
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
                            userS
                            <small>Subheading</small>
                        </h1>
 <form action="add_user.php" method="post" accept-charset="utf-8"
 enctype="multipart/form-data">

                            <div class="col-md-6 col-md-offset-3">
                             <div class="form-group">
                                <input type="file" name="user_image" >
                            </div>
                            <div class="form-group">

                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>

                            <div class="form-group">
                            <label for="fisrt_name">Firstname</label>
                                <input type="text" name="first_name" class="form-control" >
                            </div>

                            <div class="form-group">
                            <label for="last_name">Last Name</label>

                                <input type="text" name="last_name" class="form-control" >
                            </div>

                            <div class="form-group">
                            <label for="password">Password</label>
                               <input type="password" name="password" class="form-control" value="" placeholder="">
                            </div>

                             <div class="form-group">

                               <input type="submit" name="create" class="btn btn-primary pull-left" value="Create" placeholder="">
                            </div>
                        </div>

 </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>


            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/footer.php';?>