<?php require "database.php"; ?>
<?php require_once "include/header.php";  ?>
<?php require_once "include/navbar.php"; ?>
<?php require_once "include/sidebar.php";?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blog Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="blogs.php">Blogs</a></li>
              <li class="breadcrumb-item active">Blog Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
if(isset($_GET["id"])){
    $message=$db->prepare("SELECT * FROM blog_add WHERE id=:id");
    $message->execute(["id" =>$_GET["id"]]);
    $row=$message->fetch(PDO::FETCH_OBJ); 
}
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title" > <?= $row->title ?></h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- /.float-right -->
              </div>
              <table class="table">
                <tr>
                    <td>Name :</td>
                    <td><?=$row->title?></td>
                </tr>
                <tr>
                    <td>Leader :</td>
                    <td><?=$row->leader?></td>
                </tr>
                <tr>
                    <td>Description :</td>
                    <td><?=$row->description?></td>
                </tr>
                <tr>
                    <td>İmage :</td>
                    <td>
                      <image src="../assets/img/blog/<?= $row->image ?>" alt="" height="75">
                    </td>
                </tr>


              </table>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    


    
  </div>
  <!-- /.content-wrapper -->



<?php require_once("include/footer.php")   ?>