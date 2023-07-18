<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./vendors/feather/feather.css">
  <link rel="stylesheet" href="./vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="./images/favicon.png" />
</head>

<body>
  <?php
  include 'config.php';
  ?>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="./images/logo.svg" alt="logo">
              </div>
              <?php
              session_start();
              if (isset($_SESSION['username'])) {
                header("location: https://wpschool.it/projectwork/zinga/");
              }
              if (isset($_SESSION['message']) && $_SESSION['message'] == 'error') {
                $_SESSION['message'] = '';
                echo '
                    <div class="w-75 mx-auto">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body mx-auto">Username o Password errati</div>
                        </div>
                    </div>
                    ';
              }
              if (isset($_SESSION['message']) && $_SESSION['message'] == 'registered') {
                $_SESSION['message'] = '';
                echo '
                    <div class="w-75 mx-auto">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body mx-auto">L\'utente è stato registrato corettamente</div>
                        </div>
                    </div>
                    ';
              }
              if (isset($_SESSION['message']) && $_SESSION['message'] == 'not registered') {
                $_SESSION['message'] = '';
                echo '
                      <div class="w-75 mx-auto">
                          <div class="card bg-danger text-white mb-4">
                              <div class="card-body mx-auto">L\'utente non è stato registrato</div>
                          </div>
                      </div>
                      ';
              }
              ?>
              <h3 class="text-center font-weight-bold">ACCEDI</h3>
              <!-- <h6 class="font-weight-light">Sign in to continue.</h6> -->
              <form method="POST" action="./access.php" class="pt-3">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="user_name" value="rossi@dottore.com">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> -->
                <!-- <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div> -->
              </form>
            </div>
            user: rossi@dottore.com<br>
            passw: clinica2023
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="./vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="./js/off-canvas.js"></script>
  <script src="./js/hoverable-collapse.js"></script>
  <script src="./js/template.js"></script>
  <script src="./js/settings.js"></script>
  <script src="./js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>