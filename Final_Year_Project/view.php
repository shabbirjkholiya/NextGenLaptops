<?php
session_start();
include("include/connect.php");

// Retrieve query parameters
$name = isset($_GET["full_name"]) ? htmlspecialchars($_GET["full_name"]) : "N/A";
$email = isset($_GET["email"]) ? htmlspecialchars($_GET["email"]) : "N/A";
$address = isset($_GET["address"]) ? htmlspecialchars($_GET["address"]) : "N/A";
$city = isset($_GET["city"]) ? htmlspecialchars($_GET["city"]) : "N/A";
$state = isset($_GET["state"]) ? htmlspecialchars($_GET["state"]) : "N/A";
$zip_code = isset($_GET["zip_code"]) ? htmlspecialchars($_GET["zip_code"]) : "N/A";

// Retrieve cart data from query parameters
$cart_data_json = isset($_GET["cart_data"]) ? $_GET["cart_data"] : "[]";
$cart_data = json_decode(urldecode($cart_data_json), true);

$total_amount = 0; // Initialize total amount
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Your CSS styles remain unchanged */
        @import url('https://fonts.googleapis.com/css?family=Oswald');
        body {
            background-color: #dadde6;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 90%;
            margin: 100px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-transform: uppercase;
            font-weight: 900;
            border-left: 10px solid #fec500;
            padding-left: 10px;
            margin-bottom: 30px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details th, .invoice-details td {
            padding: 10px;
            text-align: left;
        }
        .invoice-summary {
            margin-top: 20px;
        }
        .invoice-summary th, .invoice-summary td {
            padding: 10px;
            text-align: right;
        }
        .custom-blue {
            background-color: rgb(58, 58, 148);
            color: #ffffff;
            border-radius: 20px;
            cursor: pointer;
            padding: 12px;
            min-width: 100px;
            text-align: center;
        }
        .custom-blue:hover {
            background-color: rgb(81, 81, 229);
        }
        .custom-link {
            color: rgb(58, 58, 148);
        }
        .custom-link:hover {
            color: rgb(81, 81, 229);
        }
        @media print {
            .no-print {
                visibility: hidden;
            }
        }
        .header {
            background-color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #2a2a8e;
        }
        .header a {
            text-decoration: none;
            color: #2a2a8e;
            font-size: 14px;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-header h1 {
            margin: 0;
            color: #333;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <div class="header">
        <h1>NextGenLaptops | Invoice</h1>
        <a href="index.php">Back To Portal</a>
    </div>

    <section class="container mt-10">
        <h1>Invoice</h1>
        <table class="invoice-details w-full">
            <tr>
                <th>Name:</th>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><?php echo $address; ?></td>
            </tr>
            <tr>
                <th>City:</th>
                <td><?php echo $city; ?></td>
            </tr>
            <tr>
                <th>State:</th>
                <td><?php echo $state; ?></td>
            </tr>
            <tr>
                <th>Zip Code:</th>
                <td><?php echo $zip_code; ?></td>
            </tr>
            <tr>
                <th>Purchase Date:</th>
                <td>2025-02-07</td>
            </tr>
        </table>
        <table class="invoice-summary w-full border-t border-gray-300 mt-4">
            <tr>
                <th>Product</th>
                <th>Detail</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
            <?php
            foreach ($cart_data as $cart_item) {
                $prod_id = $cart_item['Prod_ID'];
                $quantity = $cart_item['Quantity'];

                // Fetch product details
                $product_query = "SELECT * FROM product WHERE Prod_ID = $prod_id";
                $product_result = mysqli_query($conn, $product_query);

                if (!$product_result) {
                    die("Product query failed: " . mysqli_error($conn));
                }

                $product = mysqli_fetch_assoc($product_result);
                $subtotal = $quantity * $product['Price'];
                $total_amount += $subtotal; // Add to total amount
                ?>
                <tr>
                    <td><?php echo $product['Prod_Name']; ?></td>
                    <td><?php echo $product['Description']; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>Rs. <?php echo $product['Price']; ?></td>
                    <td>Rs. <?php echo $subtotal; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th colspan="4">Total Amount</th>
                <td>Rs.</td>
            </tr>
        </table>
        <div class="no-print text-right mt-4">
            <button onclick="window.print()" class="custom-blue">Print</button>   
        </div>
    </section>
</body>
</html>