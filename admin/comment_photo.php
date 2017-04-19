 <?php include 'includes/header.php';
if (!$session->is_signed_in()) {
    redirect("login.php");
}
?>

<?php
if(empty($_GET['id'])){
    redirect("photos.php");
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
                            comments
                            <small>Subheading</small>
                        </h1>
                        <a href="add_comment.php" class="btn btn-primary" title="">Add comment</a>
                        <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Body</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($comments as $comment): ?>
                                <tr>
                                    <td><?php echo $comment->id; ?></td>

                                    <td>
                                        <?php echo $comment->author; ?>
                                        <div class="pictures_link">
                                            <a href="delete_comment.php?id=<?php echo $comment->id; ?>" title="">Delete</a>
                                        </div>

                                    </td>
                                    <td><?php echo $comment->body; ?></td>

                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table> <!-- end table -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>


            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/footer.php';?>