<?php
session_start();
include("../include/connect.php");
extract($_GET); // Changed from $_POST to $_GET

// Debug: Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['user_data'])) {
    header("Location: ../User/ULogin.php");
    exit();
}

// Fetch user data
$user_data = $_SESSION['user_data'];
$user_id = $user_data['User_ID'];

// Debug: Print user data
echo "<script>console.log('User ID: " . $user_id . "');</script>";

// Initialize error messages
$errors = [];

// Process the order after payment is successful
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["proceed_to_pay"])) { // Changed from POST to GET
    // Validate billing address fields
    $full_name = trim($_GET['full_name']); // Changed from $_POST to $_GET
    $email = trim($_GET['email']); // Changed from $_POST to $_GET
    $address = trim($_GET['address']); // Changed from $_POST to $_GET
    $city = trim($_GET['city']); // Changed from $_POST to $_GET
    $state = trim($_GET['state']); // Changed from $_POST to $_GET
    $zip_code = trim($_GET['zip_code']); // Changed from $_POST to $_GET
    $payment_method = isset($_GET['payment_method']) ? trim($_GET['payment_method']) : ''; // Changed from $_POST to $_GET

    // Basic required field validation
    if (empty($full_name)) {
        $errors['full_name'] = "Full Name is required.";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }
    if (empty($city)) {
        $errors['city'] = "City is required.";
    }
    if (empty($state)) {
        $errors['state'] = "State is required.";
    }
    if (empty($zip_code)) {
        $errors['zip_code'] = "Zip Code is required.";
    }
    if (empty($payment_method)) {
        $errors['payment_method'] = "Payment Method is required.";
    }

    // If no errors, proceed with order placement
    if (empty($errors)) {
        // Fetch cart data for the user
        $cart_query = "SELECT * FROM cart WHERE User_ID = $user_id";
        $cart_result = mysqli_query($conn, $cart_query);

        if (!$cart_result) {
            die("Cart query failed: " . mysqli_error($conn));
        }

        // Insert each cart item into the orders table
        while ($cart_item = mysqli_fetch_assoc($cart_result)) {
            $prod_id = $cart_item['Prod_ID'];
            $quantity = $cart_item['Quantity'];
            $order_status = 'Pending'; // Default order status

            // Insert into orders table
            $order_query = "INSERT INTO `orders` (`User_ID`, `Prod_ID`, `Quantity`, `Order_Status`) VALUES ($user_id, $prod_id, $quantity, '$order_status')";
            $order_result = mysqli_query($conn, $order_query);

            if (!$order_result) {
                echo "<script>alert('Failed to add order item: " . mysqli_error($conn) . "');</script>";
                break;
            }

            // Insert into payment table for each cart item
            $pay_qry = "INSERT INTO `payment` (`User_ID`, `Prod_ID`, `Name`, `E_Mail`, `Address`, `City`, `State`, `Pincode`, `Method`) VALUES ($user_id, $prod_id, '$full_name', '$email', '$address', '$city', '$state', '$zip_code', '$payment_method')";
            $pay_res = mysqli_query($conn, $pay_qry);

            if (!$pay_res) {
                echo "<script>alert('Failed to add payment item: " . mysqli_error($conn) . "');</script>";
                break;
            }
        }

        // Clear the cart after placing the order
        $clear_cart_query = "DELETE FROM cart WHERE User_ID = $user_id";
        $clear_cart_result = mysqli_query($conn, $clear_cart_query);
        if (!$cart_result) {
            die("Cart query failed: " . mysqli_error($conn));
        }
        
        // Prepare cart data to pass to view.php
        $cart_data = [];
        while ($cart_item = mysqli_fetch_assoc($cart_result)) {
            $cart_data[] = $cart_item;
        }
        
        // Redirect to view.php with cart data
        $cart_data_json = urlencode(json_encode($cart_data));
        if ($clear_cart_result) {
            echo "<script>alert('Order placed successfully!');</script>";
            // Redirect to order confirmation page with query parameters
            echo "<script>window.location = '../index.php'</script>";
        } else {
            echo "<script>alert('Failed to clear cart: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Checkout</title>
    <style>
        /* Your CSS styles remain unchanged */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
        }
        .header {
            background: white;
            padding: 7px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
        }
        .header h1 {
            color: #2a2a8e;
            font-size: 20px;
        }
        .header a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 85%;
            max-width: 900px;
            margin: 20px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .row {
            display: flex;
            justify-content: space-between;
        }
        .row .form-group {
            width: 48%;
        }
        .cards {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .cards img {
            height: 30px;
        }
        .payment-container {
            display: flex;
            justify-content: space-between;
        }
        .billing, .payment {
            width: 48%;
        }
        .btn {
            width: 100%;
            height: 30px;
           
            font-size: 16px;
            Background-color: #2a2a8e;
            color: #fff;
            border-radius: 20px;
            border: none;
        }
        .btn:hover {
            height: 30px;
            width: 100%;
            font-size: 16px;
            Background-color: #fff;
            border: 1px solid#2a2a8e;
            color: #2a2a8e;
            border-radius: 20px;
            transition: 0.5s;
        }
        .payment-options {
            margin-bottom: 20px;
        }
        .payment-options label {
            margin-right: 20px;
            font-weight: normal;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>NextGenLaptops</h1>
        <a href="../index.php">Back To Portal</a>
    </div>
    <div class="container">
        <h2>Payment Checkout</h2>
        <form method="GET"> <!-- Changed from POST to GET -->
            <!-- Your form fields here -->
            <div class="payment-options">
                <label>
                    <input type="radio" name="payment_method" value="CON" <?php echo (!isset($_GET['payment_method']) || $_GET['payment_method'] == 'CON') ? 'checked' : ''; ?> onchange="this.form.submit()"> Cash on Delivery (CON)
                </label>
                <label>
                    <input type="radio" name="payment_method" value="card" id="card_payment" <?php echo (isset($_GET['payment_method'])) && $_GET['payment_method'] == 'card' ? 'checked' : ''; ?> onchange="this.form.submit()"> Card
                </label>
            </div>
            <div class="payment-container">
                <div class="billing">
                    <h3>Billing Address</h3>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter Your Email">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text"  name="address" placeholder="Enter Your Address">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" placeholder="Enter Your City">
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>State</label>
                            <select  name="state">
                                <option>Choose State</option>
                                <option value="Gujrat">Gujrat</option>
                                <option value="Uttar pradesh">Uttar pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Punjab">Punjab</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" name="zip_code" placeholder="Zip Code">
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['payment_method']) && $_GET['payment_method'] == 'card'): ?> <!-- Changed from $_POST to $_GET -->
                <div class="payment" id="card_details">
                    <h3>Payment Details</h3>
                    <div class="cards">
                        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/c/c0/RuPay.svg" alt="RuPay">-->
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa">
                    </div>
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" placeholder="Enter Card Number">
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Exp Month</label>
                            <input type="text" placeholder="Enter Exp Month">
                        </div>
                        <div class="form-group">
                            <label>Exp Year</label>
                            <select>
                                <option>2025</option>
                                <option>2026</option>
                                <option>2027</option>
                                <option>2028</option>
                                <option>2029</option>
                                <option>2030</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>CVV</label>
                            <input type="text" placeholder="CVV">
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <button type="submit" name="proceed_to_pay" class="btn">Proceed To Pay</button>
        </form>
    </div>
</body>
</html>