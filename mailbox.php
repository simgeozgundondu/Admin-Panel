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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Inbox</h3>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Edit</th>

                  </thead>
                  <tbody>
                  <?php
                  $contact=$db->query("SELECT * FROM contact")->fetchAll(PDO::FETCH_OBJ);
                  foreach($contact as $row){
                ?>
                  <tr>
                    <td><?=$row->id?></td>
                    <td class="mailbox-name"><a href="read-mail.php"><?=$row->name?></a></td>
                    <td class="mailbox-email"><b><?=$row->email?></b></td>
                    <td class="mailbox-date"><?=$row->date?></td>
                    <td>
                      <?php
                        if($row->status==0){
                          echo '<span class="label label-danger">unchecked</span>';
                        }
                        else{
                          echo '<span class="label label-success">checked</span>';
                        }
                        ?>
                    </td>
                    <td>
                    <a href="read-mail.php?id=<?= $row->id ?>"><i class="fa fa-eye text-primary"></i></a>
                    <a href="?delete=<?= $row->id ?>"><i class="fa fa-trash text-danger"></i></a>
                    </td>
                  </tr>
                  <?php
                    }
              ?>
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                
                <!-- /.btn-group -->
                <div class="float-right">
                  1-50
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <?php
    if(@$_GET["delete"]){
      $delete=$db->prepare("DELETE FROM contact WHERE id=:deleted_id");
      $delete->execute(["deleted_id" => $_GET["delete"]]);

      if($delete){
        header("Location:mailbox.php");
      }
    }
    
    ?>
  </div>
  <!-- /.content-wrapper -->













<?php require_once("include/footer.php")   ?>