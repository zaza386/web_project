<?php $prefix = "../"; ?>
<?php include $prefix . "header.php"; ?>
<!DOCTYPE html>
<!-- Budur Alqattan --> 
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact Us | Glamour</title>
    <!-- Plugins CSS File --> 
    <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">  
    <!-- Main CSS File --> 
    <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/cart.css">
</head>
<body>
    <div class="page-wrapper">

        <div id="signin" class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('<?= $prefix ?>images/glamourx4.jpg')">
            <div class="container" >
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="true">Sign In</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="signin-email-2">Username or email address *</label>
                                        <input type="text" class="form-control" id="signin-email-2" name="signin-email" required>
                                    </div><!-- End .form-group -->
        
                                    <div class="form-group">
                                        <label for="signin-password-2">Password *</label>
                                        <input type="password" class="form-control" id="signin-password-2" name="signin-password" required>
                                    </div><!-- End .form-group -->

                                    <div>
                                        <hr>
                                        <a href="mange products.html" class="btn btn-primary btn-round"><span>Login</span><i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .container -->
        </div><!-- End .login-page section-bg -->

    </div><!-- End .page-wrapper -->

    <?php include $prefix . "footer.php"; ?>
</body>
</html>
