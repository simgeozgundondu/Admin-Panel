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
            <h1>Blog Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="blogs.php">Blogs</a></li>
              <li class="breadcrumb-item active">Blog Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
                          Blog has been successfully added
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


              <form action="blog-add.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inputName">Blog Name</label>
                  <input type="text" id="inputName" name="title" class="form-control" placeholder="Enter blog name" required>
                </div>
                <div class="form-group">
                  <label for="inputDescription">Blog Description</label>
                  <textarea id="inputDescription" name="description" class="form-control" rows="4" placeholder="Enter blog description" required></textarea>
                </div>
                <div class="form-group">
                  <label for="inputProjectLeader">Blog Leader</label>
                  <input type="text" id="inputProjectLeader"name="leader" class="form-control" placeholder="Enter blog leader" required>
                </div>
                <div class="form-group">
                  <label>Blog Image</label><br>
                  <input type="file" placeholder="Enter blog name" name="image"/>
                </div>
              </div>
            
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new Project" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
    if($_POST){

        $resimAdi=$_FILES["image"]["name"];
        $resimYolu="../assets/img/blog/".$resimAdi;

        if(move_uploaded_file($_FILES["image"]["tmp_name"],$resimYolu)){
            $add=$db->prepare("INSERT INTO blog_add SET
                            title=:title,
                            leader=:leader,
                            description=:description,
                            image=:image");
            $add->execute([
                "title"   =>$_POST["title"],
                "description" =>$_POST["description"],
                "leader"   =>$_POST["leader"],
                "image"    =>$resimAdi
            ]);

            if($add){
              header("location:blog-add.php?durum=ok");
            }else{
              header("location:blog-add.php?durum=no");
            }

        }
        else{
          $add=$db->prepare("INSERT INTO blog_add SET 
                          title=:title, 
                          leader=:leader,
                          description=:description");
            $add->execute([
                "title" =>$_POST["title"],
                "leader" =>$_POST["leader"],
                "description" =>$_POST["description"],
                
            ]);
            if($add){
              header("location:blog-add.php?durum=ok");
              
          }else{
              header("location:blog-add.php?durum=no");
          }
        }
    }
                
                
?>

 
  










<?php require_once("include/footer.php")   ?>
