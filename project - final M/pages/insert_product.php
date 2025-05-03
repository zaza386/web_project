<?php
//  insert product into db and the admin page and home :Budur Alqattan---------
$prefix = "../";
include $prefix . "db.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

    // Sanitize and validate inputs
    $id = intval($_POST["productId"]);
    $name = mysqli_real_escape_string($conn, $_POST["productName"]);
    $price = floatval($_POST["productPrice"]);
    $quantity = intval($_POST["productQuantity"]);
    $category = mysqli_real_escape_string($conn, $_POST["productCategory"]);
    $desc1 = mysqli_real_escape_string($conn, $_POST["productDescription"]);
    $desc2 = mysqli_real_escape_string($conn, $_POST["productDescription2"]);

    // Handle image upload
    if (isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES["productImage"]["name"]);
        $targetDir = $prefix . "images/";
        $targetFile = $targetDir . $imageName;

        // Optional: restrict to image types only
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        if (!in_array($imageFileType, $allowedTypes)) {
            die("Only JPG, JPEG, PNG & GIF files are allowed.");
        }

        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {

            // check if ID or name already exists
            $check = $conn->prepare("SELECT * FROM product WHERE idProduct = ? OR name = ?");
            $check->bind_param("is", $id, $name); // FIXED: use $id, not undefined $idProduct
            $check->execute();
            $result = $check->get_result();

            if ($result->num_rows > 0) {
                // Redirect back with error flag
                header("Location: add operation.php?error=duplicate");
                exit;
            }

            // Insert into database
            $sql = "INSERT INTO product (idProduct, name, price, stock, picture, categories, description1, description2) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "isdissss", $id, $name, $price, $quantity, $imageName, $category, $desc1, $desc2);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: mange Products.php?success=1");
                exit();
            } else {
                echo "<script>alert('Database error: " . mysqli_error($conn) . "');</script>";
            }

            mysqli_stmt_close($stmt);

        } else {
            echo "<script>alert('Failed to upload image.');</script>";
        }
    } else {
        echo "<script>alert('Image upload error.');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
}
?>
