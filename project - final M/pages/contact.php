<?php $prefix = "../"; ?>
<?php include $prefix . "header.php"; ?>



<!-- Zinab Mukhtar Al-Rashed --> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact Us | Glamour</title>
    <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">  
    <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/cart.css">
    <style>
    #contactForm {
        max-width: 600px; 
        margin: 0 auto;
    }

    #contactForm .form-group {
        margin-bottom: 3px; 
    }

    #contactForm label {
        display: block;
        font-weight: bold;
        margin-bottom: 2px; 
        font-size: 10px; 
    }

    #contactForm input,
    #contactForm select,
    #contactForm textarea {
        width: 100%;
        padding: 4px; 
        border: 1px solid #ccc;
        border-radius: 2px;
        box-sizing: border-box;
        font-size: 12px; 
    }

    #contactForm .button-container button {
        flex: 1;
        padding: 10px; /* إعادة الحشو داخل الأزرار */
        font-size: 16px; /* إعادة حجم النص داخل الأزرار */
        border-radius: 5px;
    }
  </style>
</head>
<body>
<div class="page-wrapper">

    <main class="main">
        <div class="web_name" style="background-image: url('<?= $prefix ?>images/logo2.jpg');"></div>
        <div class="page-content pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <h1 class="title">Contact Us</h1>
                        <p class="mb-2">We're here to help! Please reach out with any questions, comments, or feedback.</p>
                        <form id="contactForm" method="POST" action="">
                            <label>Name:
                                <input type="text" id="name" name="name" required>
                            </label><br>

                            <label>Email:
                                <input type="email" id="email" name="email" required>
                            </label><br>

                            <label>Phone (Optional):
                                <input type="tel" id="phone" name="phone">
                            </label><br>

                            <label>Subject:
                                <select id="subject" name="subject">
                                    <option value="support">Customer Support</option>
                                    <option value="sales">Sales Inquiry</option>
                                    <option value="feedback">Feedback</option>
                                </select>
                            </label><br>

                            <label>Message:
                                <textarea id="message" name="message" rows="5" required></textarea>
                            </label>
                            <div class="cart-buttons-total">
                                <button type="submit" class="btn-primary btn-round">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="title">Our Location</h2>
                        <p>123 Main Street</p>
                        <p>Alkhobar, Rakkah, 12</p>
                        <p>Phone: (966) 500000000</p>
                        <p>Email: glamour@iau.edu.com</p>
                        <div>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57778.67385966458!2d50.18029051421033!3d26.25700877983636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49e6f496738c6d%3A0x6a1006509a27c737!2sRakkah%2C%20Al%20Khobar%2034226%2C%20Saudi%20Arabia!5e0!3m2!1sen!2sus!4v1709403668351!5m2!1sen!2sus"
                                width="90%"
                                height="300"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Thank You Modal -->
    <div class="modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <h2>🎉 Thank You!</h2>
                    <p>Your message has been sent successfully.</p>
                    <a href="<?= $prefix ?>Index.php" id="empty-cart-button" class="btn btn-primary btn-round">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <?php include $prefix . "footer.php"; ?>
</div>

<!-- Bootstrap + Modal JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= $prefix ?>js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById("contactForm").addEventListener("submit", function(event) {
        event.preventDefault();

        // Validate Saudi phone number format
        const phoneInput = document.getElementById("phone").value.trim();
        const phoneRegex = /^(?:\+966|05)[0-9]{8}$/;

        if (phoneInput && !phoneRegex.test(phoneInput)) {
            alert("Please enter a valid Saudi phone number (e.g., +966500000000 or 0500000000).");
            return;
        }

        // Submit the form if validation passes
        this.submit();
    });
</script>
</body>
</html>
