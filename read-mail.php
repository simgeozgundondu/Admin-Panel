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
            <h1>Inbox</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Inbox</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php
if(isset($_GET["id"])){
    $message=$db->prepare("SELECT * FROM contact WHERE id=:id");
    $message->execute(["id" =>$_GET["id"]]);
    $row=$message->fetch(PDO::FETCH_OBJ); 

    $update=$db->prepare("UPDATE contact SET status=:status WHERE id=:id");
    $update->execute(["status"=>1,"id"=>$_GET["id"]]);
}
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Message From <?= $row->name ?></h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- /.float-right -->
              </div>
              <table class="table">
                <tr>
                    <td>Name :</td>
                    <td><?=$row->name?></td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><?=$row->email?></td>
                </tr>
                <tr>
                    <td>Message :</td>
                    <td><?=$row->message?></td>
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