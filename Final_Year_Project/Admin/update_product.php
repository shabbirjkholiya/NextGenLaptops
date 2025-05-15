<?php
include("../include/connect.php");
session_start();

if(!isset($_SESSION['admin_data'])) {
    header("Location: ../Admin/AdminDashbord.php");
    exit();
}

$product_id = $_POST["product_id"] ?? '';
$product_name = $_POST["product_name"] ?? '';
$company_name = $_POST["company_name"] ?? '';
$shipping_charge = $_POST["shipping_charge"] ?? '';
$price = $_POST["price"] ?? '';
$total_price = $_POST["total_price"] ?? '';
$description = $_POST["description"] ?? '';

if(isset($_POST["update_product"])) {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $company_name = $_POST["company_name"];
    $shipping_charge = $_POST["shipping_charge"];
    $price = $_POST["price"];
    $total_price = $_POST["total_price"];
    $description = $_POST["description"];

    $update_qry = "UPDATE `product` SET 
        `Prod_Name` = '$product_name',
        `Com_Name` = '$company_name',
        `Shipping_Charge` = '$shipping_charge',
        `Price` = '$price',
        `Net_Price` = '$total_price',
        `Description` = '$description'
        WHERE `Prod_ID` = '$product_id'";

    if(mysqli_query($conn, $update_qry)) {
        echo "<script>alert('Product updated successfully!'); window.location.href='AdminDashbord.php';</script>";
    } else {
        echo "<script>alert('Error updating product!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-indigo-700 mb-6">Update Product</h2>
        <form method="POST" class="space-y-4">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

            <div>
                <label class="block text-gray-700 font-medium">Product Name:</label>
                <input type="text" name="product_name" value="<?php echo $product_name; ?>" 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Company Name:</label>
                <input type="text" name="company_name" value="<?php echo $company_name; ?>" 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Shipping Charge:</label>
                <input type="text" name="shipping_charge" value="<?php echo $shipping_charge; ?>" 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Price:</label>
                <input type="text" name="price" value="<?php echo $price; ?>" 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Total Price:</label>
                <input type="text" name="total_price" value="<?php echo $total_price; ?>" 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Description:</label>
                <textarea name="description" 
                          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"><?php echo $description; ?></textarea>
            </div>

            <button type="submit" name="update_product" 
                    class="w-full bg-indigo-700 text-white py-2 px-4 rounded-lg hover:bg-indigo-800 transition">
                Update Product
            </button>
        </form>
    </div>
</body>
</html>
