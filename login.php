<?php require_once("database.php");

if (isset($_SESSION['getlabsComp'])) {
  header("Location:index.php");
}

//
if (isset($_POST['loginBtn'])) {

  $email = strip_tags($_POST['loginEposta']);
  $password = strip_tags($_POST['loginPass']);
  $med5Pass = md5($password);
  $pw = hash("sha512", $med5Pass);

  /* $loginQuery->execute([
      'un' => strip_tags($_POST['email']),
      'pw' => md5(strip_tags($_POST['password']))
  ]);
*/

  $loginQuery = $db->prepare("SELECT * FROM user WHERE eposta=:un AND password=:pw");

  $loginQuery->bindValue(":un", $email);
  $loginQuery->bindValue(":pw", $pw);
  $loginQuery->execute();
  $login = $loginQuery->rowCount();

  //user fetch infos
  $user = $loginQuery->fetch(PDO::FETCH_ASSOC);


  if ($login == 1) {
    $_SESSION['getlabsComp'] = $user['eposta'];


    header("Location:index.php?status=login");
  } else {
    header("Location:login.php?status=no");
  }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GETLABS | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="https://getsoftwarecompany.com/"><b>GET </b>Software</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" name="loginEposta" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="loginPass" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-4">
              <button type="submit" name="loginBtn" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>

    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>