<?php $prefix = "../"; ?>
<?php include $prefix . "header.php"; ?>
<!DOCTYPE html>
<!-- Budur Alqattan --> 
<!-- Added by Zahra alsuwiki: Admin login functionality -->
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
                                <?php
                                // Added by Zahra alsuwiki: Start session and check for login errors
                                session_start();
                                
                                // Added by Zahra alsuwiki: Process login form
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    require_once __DIR__ . '/../db.php';
                                    
                                    $username = $_POST['signin-email'];
                                    $password = $_POST['signin-password'];
                                    
                                    // Added by Zahra alsuwiki: Check admin credentials
                                    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
                                    $stmt->bind_param("s", $username);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    
                                    if ($result->num_rows === 1) {
                                        $admin = $result->fetch_assoc();
                                        // Added by Zahra alsuwiki: Verify password (Note: In production, use password_verify() with hashed passwords)
                                        if ($password === $admin['password']) {
                                            $_SESSION['admin_logged_in'] = true;
                                            $_SESSION['admin_id'] = $admin['idAdmin'];
                                            $_SESSION['admin_name'] = $admin['name'];
                                            header("Location: mange products.php");
                                            exit;
                                        } else {
                                            $login_error = "Invalid username or password";
                                        }
                                    } else {
                                        $login_error = "Invalid username or password";
                                    }
                                }
                                ?>
                                
                                <!-- Added by Zahra alsuwiki: Display error message if login fails -->
                                <?php if (isset($login_error)): ?>
                                <div class="alert alert-danger">
                                    <?php echo $login_error; ?>
                                </div>
                                <?php endif; ?>
                                
                                <!-- Changed by Zahra alsuwiki: Added method="POST" to form -->
                                <form method="POST" action="">
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
                                        <!-- Changed by Zahra alsuwiki: Changed link to submit button -->
                                        <button type="submit" class="btn btn-primary btn-round"><span>Login</span><i class="icon-long-arrow-right"></i></button>
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
