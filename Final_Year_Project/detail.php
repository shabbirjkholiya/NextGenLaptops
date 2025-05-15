<?php
    include('include/connect.php');
    session_start();

    $user_data = $_SESSION['user_data'] ?? null; // Use null coalescing operator for better handling
    $uid = $user_data ? htmlspecialchars($user_data['User_ID']) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/detail.css">
    <title>Product Detail Page</title>
    <style>
        .image-section {
            height: 500px;
            width: 560px;
        }
        .image-section img {
            height: 500px;
            width: 500px;
        }
        header {
            background-color: white;
            width: 1200px;
        }
    </style>
</head>
<body>
    <?php 
        extract($_POST);
        $id = $_GET["id"];

        $qry = "SELECT * FROM product WHERE Prod_ID = $id";
        $result = mysqli_query($conn, $qry);
        while($row = mysqli_fetch_array($result)) {
            $img = $row[6];
            $dis = $row[7];
            $cn = $row[2];
            $sc = $row[3];
            $price = $row[4];
            $net_p = $row[5];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
            // Check if the user is logged in
            if (!isset($_SESSION['user_data'])) {
                // Redirect to the login page if the user is not logged in
                header("Location: User/ULogin.php");// Replace 'login.php' with your actual login page
                exit();
            }

            $quantity = $_POST["quantity"];
            $net_price = $net_p * $quantity + $sc;

            // Insert product details into the cart table
            $qry = "INSERT INTO `cart` (`Prod_ID`, `User_ID`, `Prod_Img`, `Prod_Name`, `Quantity`, `Shipping_Charge`, `Price`, `Net_Price`) 
                    VALUES ($id, $uid, '$img', '$dis', $quantity, $sc, $price, $net_price)";
            $result = mysqli_query($conn, $qry);
            if ($result) {
                echo "<script>alert('Added into cart');</script>";
            } else {
                echo "<script>alert('NOT Added into cart');</script>";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["wish"])) {
            // Check if the user is logged in
            if (!isset($_SESSION['user_data'])) {
                // Redirect to the login page if the user is not logged in
                header("Location: User/ULogin.php"); // Replace 'login.php' with your actual login page
                exit();
            }

            // Insert product details into the wishlist table
            $qry = "INSERT INTO `wishlist` (`User_ID`, `Prod_ID`) VALUES ('$uid', '$id');";
            $result = mysqli_query($conn, $qry);
            if ($result) {
                echo "<script>alert('Added into wishlist');</script>";
            } else {
                echo "<script>alert('NOT Added into wishlist');</script>";
            }
        }
    ?>
    <div class="container">
        <header>
            <h1>NextGenLaptops</h1>
            <a href="index.php">Back To Portal</a>
        </header>
        <main>
            <div class="image-section">
                <img src="Assest/Product_Image/<?php echo $img; ?>" alt="Aspire 3">
            </div>
            <form method="POST" class="details-section">
                <h1><?php echo $dis; ?></h1>
               
                <p class="brand">Product Brand: <span><?php echo $cn; ?></span></p>
                <p class="shipping">Shipping Charge: <span><?php echo $sc; ?></span></p>
                <p class="price">Rs. <?php echo  $net_p; ?></p>
                <div class="quantity">
                    <label for="quantity">QTY:</label>
                    <input type="number" id="quantity" name="quantity" value="1">
                </div>
                <input type="submit" name="add_to_cart" value="Cart" class="add-to-cart wish"/>
                <?php
                    error_reporting(0);
                    extract($_POST);
                    if (isset($_POST["wish"])) {
                        echo "<button type='submit' class='add-to-cart wish' name='wish'><i class='fa-solid fa-heart'></i></button>";
                    } else {
                        echo "<button type='submit' class='add-to-cart wish' name='wish'><i class='fa-regular fa-heart'></i></button>";
                    }
                ?>
            </form>
        </main>
    </div>
</body>
</html>