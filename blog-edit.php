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
            <h1>Blog Update</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="blogs.php">Blogs</a></li>
              <li class="breadcrumb-item active">Blog Update</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php                   

if(isset($_GET["id"])){
  $blog_detail=$db->prepare("SELECT * FROM blog_add WHERE id=:id");
  $blog_detail->execute(["id" => $_GET["id"]]);
  $row=$blog_detail->fetch(PDO::FETCH_OBJ);                                  
}
?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline" >
            <div class="card-body">
            <?php
              if(@$_GET["durum"]=="ok"){
                    ?>
                      <div class="alert alert-success">
                          Blog has been successfully updated
                      </div>
                  <?php
                    
              }
              if(@$_GET["durum"]=="no"){
                  ?>
                      <div class="alert alert-danger">
                          An error occurred
                      </div>
                  <?php
              }
          ?>
              <form action="blog-edit.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inputName">Blog Name</label>
                  <input type="text" id="inputName" name="title" class="form-control" value="<?= $row->title ?>">
                </div>
                <div class="form-group">
                  <label for="inputDescription">Blog Description</label>
                  <textarea id="inputDescription" name="description" class="form-control" rows="4"><?= $row->description?></textarea>
                </div>
                <div class="form-group">
                  <label for="inputProjectLeader">Blog Leader</label>
                  <input type="text" id="inputProjectLeader"name="leader" class="form-control" value="<?= $row->leader ?>">
                </div>
                <div class="form-group">
                  <label>Blog Image</label><br>
                  <image src="../assets/img/blog/<?= $row->image ?>" alt="" height="75">
                </div>
                <div class="form-group">
                  <label>Blog Image</label><br>
                  <input type="file" name="<?= $row->image ?>"/>
                </div>
              </div>
            
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <div class="row">
      <div class="col-12">
          <a href="blogs.php" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Update" class="btn btn-success float-left">
        </div>
      </div>

      

    </section>
    <!-- /.content -->

    <?php 
    if($_POST){
      if($_FILES["image"]["name"]){
        $resimAdi=$_FILES["image"]["name"];
        $resimYolu="../assets/img/blog/".$resimAdi;

        if(move_uploaded_file($_FILES["image"]["tmp_name"],$resimYolu)){
            $update=$db->prepare("UPDATE blog_add SET
                            title=:title,
                            leader=:leader,
                            description=:description,
                            image=:image
                            WHERE id=:id");
            $update->execute([
                "title"   =>$_POST["title"],
                "description" =>$_POST["description"],
                "leader"   =>$_POST["leader"],
                "image"    =>$resimAdi,
                "id"       =>$_GET["id"]
            ]);

            if($update){
              header("location:blog-edit.php?durum=ok");
            }else{
              header("location:blog-edit.php?durum=no");
            }

        }
    }else{
          $update=$db->prepare("UPDATE blog_add SET 
                          title=:title, 
                          leader=:leader,
                          description=:description
                          WHERE id=:id");
          $update->execute([
              "title" =>$_POST["title"],
              "leader" =>$_POST["leader"],
              "description" =>$_POST["description"],
              "id"       =>$_GET["id"]
                
          ]);
          if($update){
            header("location:blog-edit.php?durum=ok");
          }else{
            header("location:blog-edit.php?durum=no");
          }
      }
    }
                
?>
  </div>
  <!-- /.content-wrapper -->
 



<?php require_once("include/footer.php")   ?>