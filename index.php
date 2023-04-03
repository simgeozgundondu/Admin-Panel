 <?php require_once "include/header.php";  ?>
 <?php require_once "include/navbar.php"; ?>
 <?php require_once "include/sidebar.php"; ?>


 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1>BLOGS <?php print_r($_SESSION)   ?> </h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">BLOGS</li>
           </ol>
         </div>
       </div>
     </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
     <?php
      if (@$_GET["delete"]) {
        $delete = $db->prepare("DELETE FROM blog_add WHERE id=:deleted_id");
        $delete->execute(["deleted_id" => $_GET["delete"]]);

        if ($delete) {
          echo "başarılı";
          //  header("Location:blogs.php");
        } else {
          echo "bir hata var";
        }
      }

      ?>
     <!-- Default box -->
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">ALL BLOGS</h3>

         <div class="card-tools">
           <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
             <i class="fas fa-minus"></i></button>
           <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
             <i class="fas fa-times"></i></button>
         </div>
       </div>
       <div class="card-body p-0">
         <table class="table table-striped projects">
           <thead>
             <tr>
               <th style="width: 1%">
                 #
               </th>
               <th style="width: 20%">
                 Blog Name
               </th>
               <th style="width: 30%">
                 Leader
               </th>
               <th style="width: 20%">
               </th>
             </tr>

           </thead>



           <tbody>
             <?php
              $blog = $db->query("SELECT * FROM blog_add")->fetchAll(PDO::FETCH_OBJ);
              foreach ($blog as $row) {
              ?>
               <tr>
                 <td>
                   #
                 </td>
                 <td>
                   <a>
                     <?= $row->title ?>
                   </a>
                   <br />

                 </td>
                 <td>
                   <ul class="list-inline">
                     <li class="list-inline-item">
                       <a>
                         <?= $row->leader ?>
                       </a>
                     </li>

                   </ul>
                 </td>


                 <td class="project-actions text-left">
                   <a class="btn btn-primary btn-sm" href="blog-detail.php?id=<?= $row->id ?>">
                     <i class="fas fa-eye">
                     </i>
                     View
                   </a>
                   <a class="btn btn-info btn-sm" href="blog-edit.php?id=<?= $row->id ?>">
                     <i class="fas fa-pencil-alt">
                     </i>
                     Edit
                   </a>
                   <a class="btn btn-danger btn-sm" href="?delete=<?= $row->id ?>">
                     <i class="fas fa-trash">
                     </i>
                     Delete
                   </a>
                 </td>
               </tr>
             <?php } ?>

           </tbody>
         </table>
       </div>
       <!-- /.card-body -->

     </div>
     <!-- /.card -->
     <a href="blog-add.php" class="btn btn-success">
       <i class="fa fa-plus" aria-hidden="true"></i>
       Create New Blog
     </a>

   </section>







   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->



 <?php require_once("footer.php")   ?>


















































 <?php require_once("include/footer.php")   ?>