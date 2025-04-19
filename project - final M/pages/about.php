<?php $prefix = "../"; ?>
<?php include $prefix . "header.php"; ?>
<!-- Zainab Albadi --> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Glamour</title>
    <!-- Plugins CSS File --> 
    <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">  
    <!-- Main CSS File --> 
    <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
</head>
<body>
<div class="page-wrapper">

<main class="main"> <!--start page about -->
    <div class="web_name" style="background-image: url('<?= $prefix ?>images/logo2.jpg');"></div>
    <div class="page-content pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="about-text text-center mt-3">
                        <h2 class="title text-center mb-2">Who We Are</h2>
                        <p class="lead text-primary mb-3">Welcome to Glamour, where beauty meets nature! We are a brand dedicated to organic makeup, crafted with pure and natural ingredients to provide you with a safe and healthy beauty experience.</p>
                        <p class="mb-2">At Glamour, we believe that true beauty starts with the right care. That’s why we offer cosmetics that are free from harmful chemicals, made with love from organic ingredients that nourish your skin and enhance its natural glow.</p>
                        <br><br><br><br>
                    </div>
                </div>
            </div>

            <div class="page-content pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <h2 class="title">Our Values</h2>
                            <p>•	Purity – We use only natural, organic ingredients that are safe for your skin.
                                <hr> •  Transparency – We believe in honesty and clearly listing all our ingredients.
                                <hr> •	Sustainability – Our products are eco-friendly, cruelty-free, and never tested on animals.
                                <hr> •	Empowerment – We aim to inspire confidence by providing makeup that enhances natural beauty without compromising health.
                            </p>
                        </div>
                        
                        <div class="col-lg-6">
                            <h2 class="title">Our Mission</h2>
                            <p>•	Provide high-quality, toxin-free organic makeup.
                                <hr> •	Support pure beauty by using natural and skin-friendly ingredients.
                                <hr> •	Offer a luxurious and sustainable experience for every woman who values health and beauty.
                                <hr> •	Reduce environmental impact by using eco-friendly and recyclable materials.
                            </p>
                        </div>
                    </div>

                    <br><br><br><br>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-sm-6">
                            <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon"><i class="icon-pagelines"></i></span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">100% Natural & Organic Ingredients </h3>
                                    <p>Made with pure, non-toxic ingredients for safe beauty.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon"><i class="icon-close"></i></span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Cruelty-Free</h3>
                                    <p>Ethically made, never tested on animals.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon"><i class="icon-star"></i></span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Beauty with a Purpose</h3>
                                    <p>We support sustainability & empower women globally.</p> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include $prefix . "footer.php"; ?>
</div>
</body>
</html>
